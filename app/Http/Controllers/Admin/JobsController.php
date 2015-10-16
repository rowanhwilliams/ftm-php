<?php

namespace App\Http\Controllers\Admin;

use App\Models\CommisionOrBonus;
use App\Models\JobFamily;
use App\Models\Jobs;
use App\Models\Companies;
use App\Models\SupportedLanguages;
use App\Models\TargetEndUser;
use App\Models\Country;
use App\Models\AvailabilityTerritory;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("admin.jobs.index");
    }

    private function passData($id = null)
    {
        if (!is_null($id)) {
            $jobs = Jobs::findOrNew($id);
        }
        else {
            $jobs = new \App\Models\Jobs();
        }
        $comps = Companies::all(["id_Company","Company_Full_Name"])->sortBy('Company_Full_Name')->toArray();
        $commOrBon = CommisionOrBonus::all()->sortBy("Commission_Or_Bonus")->toArray();
        $jobFam = JobFamily::all()->sortBy("Job_Family")->toArray();
        $pRegions = AvailabilityTerritory::all()->toArray();
        $cn = Country::all()->sortby("Country")->toArray();
        $lns = SupportedLanguages::all()->sortBy("Language_Name")->toArray();

        //dd($commOrBon);
        if (sizeof($commOrBon) == 0) {
            $commOrBon = new \App\Models\CommisionOrBonus();
        }
        $tEndUser = TargetEndUser::all()->sortBy("Target_End_User")->toArray();

        foreach ($comps as $comp) {
            $companies[$comp["id_Company"]] = $comp["Company_Full_Name"];
        }
        foreach ($commOrBon as $commisionOrBonusVal) {
            $commisionOrBonus[$commisionOrBonusVal["id_Commission_Or_Bonus"]] = $commisionOrBonusVal["Commission_Or_Bonus"];
        }
        foreach ($tEndUser as $tgEndUser) {
            $targetEndUser[$tgEndUser["id_Target_End_User"]] = $tgEndUser["Target_End_User"];
        }
        foreach ($jobFam as $jobFamVal) {
            $jobFamily[$jobFamVal["id_Job_Family"]] = $jobFamVal["Job_Family"];
        }
        foreach ($pRegions as $prRegions) {
            $regions[$prRegions["id_Availability_Territory"]] = $prRegions["Territory_Name"];
        }
        foreach ($cn as $cnt) {
            $country[$cnt["id_Country"]] = $cnt["Country"];
        }
        foreach ($lns as $langs) {
            $languages[$langs["id_Language"]] = $langs["Language_Name"];
        }

        return compact("companies", "commisionOrBonus","targetEndUser","jobFamily","country", "regions", "jobFamily", "languages");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.jobs.create", $this->passData());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $jobFields = $this->jobValidator($request);
        $jobModel = Jobs::create($jobFields);
        return redirect(route('admin.jobs.index'))->with('flash', 'The Job was created');
    }

    public function jobValidator(Request $request)
    {
        $jobValidator = [
            'id_Company_Preference' => 'required|numeric',
            'id_job_Type' => 'required|numeric',
            'Job_Title' => 'required|string',
            'id_Target_End_User' => 'required|numeric',
            'id_Commission_Or_Bonus' => 'required|numeric',
            'Job_Max_Salary' => 'required|numeric',
            'Years_Experience_Required' => 'required|numeric',
            'Percentage_Travel' => 'required|numeric',
            'Variable_Cap' => 'sometimes|accepted',
            'Visa_Sponsorship_Possible' => 'sometimes|accepted',
            'Job_Description' => 'required|string',
            'Job_Requirements' => 'required|string'
        ];
        $this->validate($request, $jobValidator);
        foreach(array_keys($jobValidator) as $key){
            $jobFields[$key] = $request[$key];
        }
        return $jobFields;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
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
        return view("admin.jobs.create", $this->passData($id));
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
