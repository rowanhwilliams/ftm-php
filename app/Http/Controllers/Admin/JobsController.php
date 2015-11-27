<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addresses;
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
use Carbon\Carbon;

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
        $jobs = Jobs::where("Deleted", "=", NULL)->get()->sortBy("Job_Title");
        return view("admin.jobs.index", compact("jobs"));
    }

    private function passData($id = null)
    {
        $jobs = new \App\Models\Jobs();

        if (!is_null($id)) {
            $jobs = Jobs::findOrNew($id);
        }

        $companyPreference = $jobs->getCompanyPreference() ? $jobs->getCompanyPreference() : new \App\Models\CompanyPreference();
        $address = $jobs->address()->first() ? $jobs->address()->first() : new \App\Models\Addresses();

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

        $companies = Companies::SelectOptionsModel();

        $jobType = $jobs->getJobType();
        $jobFamilyOptions = JobFamily::getJobsFamilyOptions();
        $jobTypesOptions = JobType::getJobsTypesByJobFamilyOptions($jobType->id_Job_Family);

        $countryModel = $address->getCountry();
        $regionsOptions = Region::getRegionsOptions();
        $countryOptions = Country::getCountriesOptionsByRegion($countryModel->id_Region);


        return compact("companies", "commisionOrBonus","targetEndUser","jobFamilyOptions","regionsOptions", "countryOptions",
                       "languages", "jobs", "companyPreference", "address", "jobTypesOptions");
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
        $jobModel = Jobs::create($this->doValidation($request, Jobs::getValidatorRules()));
        $companyPreferenceModel = CompanyPreference::create($this->doValidation($request, CompanyPreference::getValidatorRules()));
        $addressModel = Addresses::create($this->doValidation($request, Addresses::getValidatorRules()));
        $jobModel->fill(["id_Company_Preference" => $companyPreferenceModel->id_Company_Preference,
                         "AddressId" => $addressModel->AddressId])->save();

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
        $companyPreferenceModel = CompanyPreference::findOrNew($jobModel->id_Company_Preference);

        $jobFields = $this->doValidation($request, Jobs::getValidatorRules());
        $companyPreferenceModel->fill($this->doValidation($request, CompanyPreference::getValidatorRules()))->save();

        if ($jobModel->address()->first()) {
            $jobModel->address()->first()->fill($this->doValidation($request, Addresses::getValidatorRules()))->save();
        }
        else
        {
            $adressModel = $jobModel->address()->create($this->doValidation($request, Addresses::getValidatorRules()));
            $jobFields['AddressId'] = $adressModel->AddressId;
        }

        $jobFields["id_Company_Preference"] = $companyPreferenceModel->id_Company_Preference;
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
        $jobs = Jobs::findOrFail($id);
        $jobs->fill(["Deleted" => Carbon::now()])->save();
        return redirect(route('admin.jobs.index'));
    }
}
