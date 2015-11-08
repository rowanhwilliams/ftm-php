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
use \App\Models\Positions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Employee;

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
        $people = People::all()->sortBy("First_Name");
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
            $employee = $people->employee()->get()->first();
            if ($people->address()->get()->first()) {
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
        $eType = EmployeeType::all()->sortBy("Type_Name")->toArray();

        foreach ($eType as $emType) {
            $employeeType[$emType["id_Employee_Type"]] = $emType["Type_Name"];
        }
        foreach ($pTitle as $peopTitle) {
            $peopleTitle[$peopTitle["id_People_Title"]] = $peopTitle["Title_Name"];
        }

        $regions = Region::getRegionsOptions();
        $country = Country::getCountriesOptionsByRegion();

        return compact("country", "regions", "employeeType", "people", "peopleTitle", "universityHisttory",
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
        //
    }
}
