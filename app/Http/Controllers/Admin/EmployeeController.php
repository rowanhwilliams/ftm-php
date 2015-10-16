<?php

namespace App\Http\Controllers\Admin;

use App\Models\Degree;
use App\Models\EmployeeType;
use App\Models\People;
use \App\Models\Companies;
use \App\Models\AvailabilityTerritory;
use \App\Models\Country;
use \App\Models\Positions;

use Illuminate\Http\Request;

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
        $employees = Employee::all();
        return view("admin.employee.index", ['employees'=>$employees]);
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
        if (!is_null($id)) {
            $people = People::findOrNew($id);
        }
        else {
            $people = new \App\Models\People();
        }
        $comps = Companies::all(["id_Company","Company_Full_Name"])->sortBy('Company_Full_Name')->toArray();
        $pRegions = AvailabilityTerritory::all()->toArray();
        $cn = Country::all()->sortby("Country")->toArray();
        $eType = EmployeeType::all()->sortBy("Type_Name")->toArray();
        $pPos = Positions::all()->sortBy("Position_Name")->toArray();
        $degree = Degree::all()->sortBy("Degree_title")->toArray();
        if (!sizeof($degree)) {
            $degree = new \App\Models\Degree();
        }

        foreach ($comps as $comp) {
            $companies[$comp["id_Company"]] = $comp["Company_Full_Name"];
        }
        foreach ($pRegions as $prRegions) {
            $regions[$prRegions["id_Availability_Territory"]] = $prRegions["Territory_Name"];
        }
        foreach ($cn as $cnt) {
            $country[$cnt["id_Country"]] = $cnt["Country"];
        }
        foreach ($eType as $emType) {
            $employeeType[$emType["id_Employee_Type"]] = $emType["Type_Name"];
        }
        foreach ($pPos as $prPos) {
            $positions[$prPos["id_Position"]] = $prPos["Position_Name"];
        }
        foreach ($degree as $dlist) {
            $historyDegree[$dlist["id_Degree"]] = $dlist["Degree_title"];
        }


        return compact("companies", "country", "regions", "employeeType", "positions", "historyDegree");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
