<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addresses;
use App\Models\Degree;
use App\Models\EmployeeType;
use App\Models\People;
use \App\Models\Companies;
use \App\Models\Region;
use \App\Models\Country;
use App\Models\PeopleTitle;
use \App\Models\CareerHistory;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Mockery\Exception;
use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Session::forget('UniversityHistory');
        Session::forget('CareerHistory');
        $this->convertScript();
        $people = People::whereNull("Deleted")->get()->sortBy("First_Name");
        return view("admin.employee.index", compact("people"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view("admin.employee.create", $this->passData());
    }

    private function passData($id = null)
    {
        $people = new \App\Models\People();
        $address = new \App\Models\Addresses();
        $employee = new \App\Models\Employee();
        if (!is_null($id)) {
            $people = People::findOrNew($id);
            $universityHisttory = $people->universityHistory()->get();
            $careerHistory = $people->careerHistory()->get();
            $employee = $people->employee()->first();
            if ($people->address()->first()) {
                $address = $people->address()->get()->first();
            }
        }
        else {


            if (!Session::has('UniversityHistory')) {
                Session::set('UniversityHistory', $people->universityHistory()->get());
            }

            if (!Session::has('CareerHistory')) {
                Session::set('CareerHistory', $people->careerHistory()->get());
            }

            $universityHisttory = Session::get('UniversityHistory');
            $careerHistory = Session::get('CareerHistory');

        }

        $pTitle = PeopleTitle::all()->sortBy("Title_Name")->toArray();

        foreach ($pTitle as $peopTitle) {
            $peopleTitle[$peopTitle["id_People_Title"]] = $peopTitle["Title_Name"];
        }
        $employeeType = EmployeeType::getEmployeeTypeOptions();
        $countryModel = $address->getCountry();
        $regionsOptions = Region::getRegionsOptions();
        $countryOptions = Country::getCountriesOptionsByRegion($countryModel->id_Region);

        return compact("countryOptions", "regionsOptions", "employeeType", "people", "peopleTitle", "universityHisttory",
                        "careerHistory", "employee", "address");
    }

    private function educationValidator(Request $request)
    {
        $educationValidator = [
            'University_Name' => 'required|string',
            'Degree_title' => 'required|string',
            'Start_year' => 'required|numeric',
            'Finish_year' => 'required|numeric'
        ];
        $this->validate($request, $educationValidator);
        foreach(array_keys($educationValidator) as $key){
            $educationFields[$key] = $request[$key];
        }
        return $educationFields;
    }

    private function careerValidator(Request $request)
    {
        $careerValidator = [
            'Position_Name' => 'required|string',
            'Company_Name' => 'required|string',
            'Start_year' => 'required|numeric',
            'Finish_year' => 'required|numeric',
            'Start_Month' => 'required|numeric',
            'Finish_Month' => 'required|numeric',
            'Current_Position_Status' => 'sometimes|accepted'
        ];
        $this->validate($request, $careerValidator);
        foreach(array_keys($careerValidator) as $key){
            $careerFields[$key] = $request[$key];
        }
        return $careerFields;
    }

    private function peopleValidator(Request $request)
    {
        $peopleValidator = [
            'First_Name' => 'required|string',
            'Middle_Name' => 'required|string',
            'Surname' => 'required|string',
            'Career_Description' => 'required|string',
            'id_People_Title' => 'required|numeric'
        ];
        $this->validate($request, $peopleValidator);
        foreach(array_keys($peopleValidator) as $key){
            $peopleFields[$key] = $request[$key];
        }
        $peopleFields['Date_Modified'] = Carbon::now();
        return $peopleFields;
    }

    private function employeeValidator(Request $request)
    {
        $employeeValidator = [
            'Education_Description' => 'required|string',
            'id_Employee_Type' => 'required|numeric'
        ];
        $this->validate($request, $employeeValidator);
        foreach(array_keys($employeeValidator) as $key){
            $employeeFields[$key] = $request[$key];
        }
        return $employeeFields;
    }

    private function addressValidator(Request $request)
    {
        $addressValidator = [
            'City' => 'required|string',
            'id_Country' => 'required|numeric',
            'State' => 'string'
        ];
        $this->validate($request, $addressValidator);
        foreach(array_keys($addressValidator) as $key){
            $addressFields[$key] = $request[$key];
        }
        return $addressFields;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (isset($request['add_education']) && $request['add_education']) {
            $educationData = $this->educationValidator($request);
            Session::set('UniversityHistory', Session::get('UniversityHistory')->push(new \App\Models\DegreeHistory($educationData)));
            return Redirect::back()->withInput($request->except(["University_Name","Degree_title","Start_year", "Finish_year"]));
        }

        if (isset($request['add_career']) && $request['add_career']) {
            $careerData = $this->careerValidator($request);
            Session::set('CareerHistory', Session::get('CareerHistory')->push(new \App\Models\CareerHistory([
                "Position_Name" => $careerData["Position_Name"], "Company_Name" => $careerData["Company_Name"],
                "Current_Position_Status" => $careerData["Current_Position_Status"],
                "Start_Date_At_Position" => Carbon::create($careerData["Start_year"], $careerData["Start_Month"],1,0),
                "Finish_Date_At_Position" => Carbon::create($careerData["Finish_year"], $careerData["Finish_Month"],1,0),
            ])));
            return Redirect::back()->withInput($request->except(["Position_Name","Company_Name","Start_year", "Finish_year","Start_Month", "Finish_Month", "Current_Position_Status"]));
        }

        $peopleFields = $this->peopleValidator($request);
        $employeeFields = $this->employeeValidator($request);
        $addressFields = $this->addressValidator($request);
        $addressModel = Addresses::create($addressFields);

        $peopleFields['Date_Created'] = Carbon::now();
        $peopleFields['AddressId'] = $addressModel->AddressId;
        $peopleModel = People::create($peopleFields);
        $peopleModel->employee()->create($employeeFields);


        foreach(Session::get('UniversityHistory') as $modelData){
            $peopleModel->universityHistory()->save($modelData);
        }

        foreach(Session::get('CareerHistory') as $modelData){
            $peopleModel->careerHistory()->save($modelData);
        }

        return redirect(route('admin.employee.index'))->with('flash', 'The Company was updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        return view('admin.employee.item');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view("admin.employee.edit", $this->passData($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $peopleModel = People::findOrFail($id);
        if (isset($request['add_education']) && $request['add_education']) {
            $educationData = $this->educationValidator($request);
            $peopleModel->universityHistory()->save(new \App\Models\DegreeHistory($educationData));
            return Redirect::back()->withInput($request->except(["University_Name","Degree_title","Start_year", "Finish_year"]));
        }

        if (isset($request['add_career']) && $request['add_career']) {
            $careerData = $this->careerValidator($request);
            $peopleModel->careerHistory()->save(new \App\Models\CareerHistory([
                "Position_Name" => $careerData["Position_Name"], "Company_Name" => $careerData["Company_Name"],
                "Current_Position_Status" => $careerData["Current_Position_Status"],
                "Start_Date_At_Position" => Carbon::create($careerData["Start_year"], $careerData["Start_Month"],1,0),
                "Finish_Date_At_Position" => Carbon::create($careerData["Finish_year"], $careerData["Finish_Month"],1,0),
            ]));
            return Redirect::back()->withInput($request->except(["Position_Name","Company_Name","Start_year", "Finish_year","Start_Month", "Finish_Month", "Current_Position_Status"]));
        }

        $peopleFields = $this->peopleValidator($request);

        $employeeFields = $this->employeeValidator($request);
        $addressFields = $this->addressValidator($request);

        $peopleModel->employee()->first()->fill($employeeFields)->save();
        if ($peopleModel->address()->first()) {
            $peopleModel->address()->first()->fill($addressFields)->save();
        }
        else
        {
            $adressModel = $peopleModel->address()->create($addressFields);
            $peopleFields['AddressId'] = $adressModel->AddressId;
        }
        $peopleModel->fill($peopleFields)->save();

        return redirect(route('admin.employee.index'))->with('flash', 'The Company was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $peoples = People::findOrFail($id);
        $peoples->fill(["Deleted" => Carbon::now()])->save();
        return redirect(route('admin.employee.index'));
    }

    public function convertScript() {
        $data = 'data';
        Excel::load('/storage/app/Medium1.xlsx', function($reader) use($data) {
            $existsData = [];
            $reader->each(function($sheet) use ($existsData) {
                $company = $sheet->getTitle();
                $companyModel = Companies::where("Company_Full_Name", "like", "%$company%")->first();

                $rowData = $sheet->toArray();
                foreach ($rowData as $row)
                {
                    if (isset($row) && count($row)) {
                        $name = isset($row['name']) ? trim($row['name']) : "";

                        if (!strlen($name) && in_array(strtolower($name), $existsData)) {
                            continue;
                        }
                        $title = isset($row['title']) ? trim($row['title']) : "";
                        $description = isset($row['description']) ? trim($row['description']) : "";

//                        $employeeType = EmployeeType::all(["Type_Name"])->toArray();
//
//                        $present = [];
//                        foreach ($employeeType as $aType) {
//                            if (!in_array($aType["Type_Name"], $present)) $present[] = strtolower($aType["Type_Name"]);
//                        }
////                        echo "<pre>";
////                        print_r($present);
////                        echo "</pre>";
//                        $Employee_types = [];
//
//                        $ptitle = explode(",", $title);
//
//                        foreach ($ptitle as $part) {
//                            $title_part = trim(strtolower($part));
//                            if (strlen($title_part) == 0) {
//                                continue;
//                            }
//                            $created = false;
//                            foreach ($present as $item) {
//                                $sameLatters = similar_text(strtolower($item), $title_part, $per);
//                                if ($per < 80 && !in_array($title_part, $present)) {
//                                    $created = true;
//                                    $present[] = $title_part;
//                                    $Employee_types[] = EmployeeType::create(["Type_Name" => ucwords($title_part)]);
//                                }
//                            }
//                            if (!$created) {
//                                $Employee_types[] = EmployeeType::where("Type_Name", 'like', "%" . ucwords($title_part) . "%")->get()->first();
//                            }
//
//                        }
//
                        $flname = explode(" ", $name);

                        $peopleFields = [];
                        $addressFields = [];
                        $employeeFields = [];
                        $peopleFields['First_Name'] = is_array($flname) && isset($flname[0]) && strlen($flname[0]) ? $flname[0] : "";
                        $peopleFields['Surname'] = is_array($flname) && isset($flname[1]) && strlen($flname[1]) ? $flname[1] : "";

                        if (count($flname) == 3 && $description != "") {
                            $peopleModel = People::where("Career_Description", "like", "%$description%")->get();
                            if ($peopleModel->count()) {
                                foreach($peopleModel as $pModel) {
                                    $peopleFields['Surname'] = is_array($flname) && isset($flname[2]) && strlen($flname[2]) ? $flname[2] : "";
                                    $peopleFields['Middle_Name'] = is_array($flname) && isset($flname[1]) && strlen($flname[1]) ? $flname[1] : "";
                                    echo $peopleFields['First_Name']." : ".$peopleFields['Middle_Name']." : ".$peopleFields['Surname'];
                                    $pModel->fill($peopleFields)->save();
                                }
                            }
                        }

//
//                        if ($peopleFields['First_Name'] && $peopleFields['First_Name'] || ($peopleFields['First_Name'])) {
//                            $addressModel = Addresses::create($addressFields);
//                            $peopleFields['Career_Description'] = $description;
//                            $peopleFields['Date_Created'] = Carbon::now();
//                            $peopleFields['AddressId'] = $addressModel->AddressId;
//                            $peopleModel = People::create($peopleFields);
//                            if ($companyModel) {
//                                $peopleModel->careerHistory()->save(new \App\Models\CareerHistory([
//                                    "Position_Name" => $title, "Company_Name" => $companyModel->Company_Full_Name,
//                                    "Current_Position_Status" => 1
//                                ]));
//                            }
//                            $employeeModel = $peopleModel->employee()->create($employeeFields);
//                            foreach ($Employee_types as $EmployeeType) {
//                                $employeeModel->employeeType()->save($EmployeeType);
//                            }
//
//                        }
//                        $existsData[] = strtolower($name);
                    }
//
//
//                     Loop through all rows
//                $sheet->each(function($row) {
//                    echo $row;
//                });

                }
            });
        });
    }
}
