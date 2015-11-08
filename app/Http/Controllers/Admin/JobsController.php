<?php

namespace App\Http\Controllers\Admin;

use App\Models\CommisionOrBonus;
use App\Models\CompanyPreference;
use App\Models\JobFamily;
use App\Models\Jobs;
use App\Models\Companies;
use App\Models\JobType;
use App\Models\Region;
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
        $jobs = Jobs::all()->sortBy("Job_Title");
        return view("admin.jobs.index", compact("jobs"));
    }

    private function passData($id = null)
    {
        if (!is_null($id)) {
            $jobs = Jobs::findOrNew($id);
        } else {
            $jobs = new \App\Models\Jobs();

        }
        if ($jobs->id_Company_Preference)
        {
            $companyPreference = CompanyPreference::where("id_Company_Preference", "=", $jobs->id_Company_Preference)->get()->first();
        }
        else
        {
            $companyPreference = new \App\Models\CompanyPreference();
        }
        $commOrBon = CommisionOrBonus::all()->sortBy("Commission_Or_Bonus")->toArray();
        $lns = SupportedLanguages::all()->sortBy("Language_Name")->toArray();

         if (sizeof($commOrBon) == 0) {
            $commOrBon = new \App\Models\CommisionOrBonus();
        }
        $tEndUser = TargetEndUser::all()->sortBy("Target_End_User")->toArray();

        foreach ($commOrBon as $commisionOrBonusVal) {
            $commisionOrBonus[$commisionOrBonusVal["id_Commission_Or_Bonus"]] = $commisionOrBonusVal["Commission_Or_Bonus"];
        }
        foreach ($tEndUser as $tgEndUser) {
            $targetEndUser[$tgEndUser["id_Target_End_User"]] = $tgEndUser["Target_End_User"];
        }

        foreach ($lns as $langs) {
            $languages[$langs["id_Language"]] = $langs["Language_Name"];
        }

        $companies = Companies::getCompaniesOptions();
        $regions = Region::getRegionsOptions();
        $jobFamily = JobFamily::getJobsFamilyOptions();
        $country = Country::getCountriesOptionsByRegion();
        if (is_null($jobs->id_Job_Type))
        {
            $id_Job_Family = 1;
            $jobTypes = JobType::getJobsTypesByJobFamilyOptions();
        }
        else {
            $id_Job_Family = JobType::where("id_Job_Type", "=", $jobs->id_Job_Type)->get()->first()->id_Job_Family;
            $jobTypes = JobType::getJobsTypesByJobFamilyOptions($id_Job_Family);
        }

        return compact("companies", "commisionOrBonus","targetEndUser","jobFamily","country", "regions", "languages", "jobs",
                        "jobTypes", "id_Job_Family", "companyPreference");
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
        $preferenceFields = $this->doValidation($request, CompanyPreference::getValidatorRules());
        $preferenceModel = CompanyPreference::create($preferenceFields);
        $jobFields = $this->doValidation($request, Jobs::getValidatorRules());
        $jobFields["id_Company_Preference"] = $preferenceModel->id_Company_Preference;
        $jobModel = Jobs::create($jobFields);
        //$jobModel->companyPreference()->save(new \App\Models\CompanyPreference($preferenceFields));
        return redirect(route('admin.jobs.index'))->with('flash', 'The Job was created');
    }

    public function doValidation(Request $request, $validateRules)
    {
        $requestFields = [];
        $this->validate($request, $validateRules);
        foreach(array_keys($validateRules) as $key){
            $requestFields[$key] = $request[$key];
        }
        return $requestFields;
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
        return view("admin.jobs.edit", $this->passData($id));
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
        $jobModel = Jobs::findOrNew($id);
        $jobFields = $this->doValidation($request, Jobs::getValidatorRules());
        $preferenceFields = $this->doValidation($request, CompanyPreference::getValidatorRules());
        $jobModel->companyPreference()->fill($preferenceFields)->save();
        $jobModel->fill($jobFields)->save();


        return redirect(route('admin.jobs.index'))->with('flash', 'The Job was saved');
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
