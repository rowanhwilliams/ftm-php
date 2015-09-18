<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addresses;
use App\Models\MediaContacts;
use App\Models\Phones;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Input;
use Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ownership;
use App\Models\Companies;
use App\Models\EmployeeSize;
use App\Models\GrowthProfile;
use App\Models\RevenueStage;
use App\Models\CompanyType;
use App\Models\CompanySubType;
use App\Models\ProductFocusType;
use App\Models\ProductFocus;
use App\Models\ProductFocusSubType;
use App\Models\HeadquartersInformation;
use App\Models\Country;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $companies = Companies::all(['id_Company','Company_Full_Name','Year_Founded','Website']);
        // empty session data
        Session::forget('MediaContacts');
        return view("admin.companies.index", compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.companies.create", $this->passData());
    }

    private function passData($id = null)
    {
        if (!is_null($id)) {
            $company = Companies::findOrNew($id);
            $mediaContacts = $company->mediaContacts()->get();
        }
        else {
            $company = new \App\Models\Companies();
            if (!Session::has('MediaContacts')) {
                Session::set('MediaContacts', $company->mediaContacts()->get());
            }
            $mediaContacts = Session::get('MediaContacts');
        }

        $eSize = EmployeeSize::all()->toArray();
        $gProfile = GrowthProfile::all()->toArray();
        $oship = Ownership::all()->toArray();
        $rStage = RevenueStage::all()->toArray();
        $cType = CompanyType::all()->toArray();
        $csType = CompanySubType::all()->toArray();
        $uParent = Companies::all()->toArray();
        $pFocus = ProductFocus::all();
        $pfType = ProductFocusType::where("id_Product_Focus", "=", "1")->get()->toArray();
        $pfsType = ProductFocusSubType::where("id_Product_Focus_Type", "=", "1")->get()->toArray();
        $cn =Country::all()->toArray();

        if ($company->headquaters()->count()) {
            $HQAddresses = $company->headquaters()->get()->first()->addresses()->get()->first();
        }
        else {
            $HQAddresses = new \App\Models\Addresses();
        }

        if ($company->headquaters()->count()){
            $HQPhones = $company->headquaters()->first()->phones()->get()->first();
        }
        else {
            $HQPhones = new \App\Models\Phones();
        }

        //
        //dd($HQPhones);

        foreach ($eSize as $emSize){
            $employeeSize[$emSize["id_Employee_Size"]] = $emSize["Employee_Size"];
        }
        foreach ($gProfile as $gwProfile){
            $growthProfile[$gwProfile["id_Growth_Profile"]] = $gwProfile["Growth_Profile"];
        }
        foreach ($oship as $owship) {
            $ownership[$owship["id_Ownership"]] = $owship["Ownership"];
        }
        foreach ($rStage as $revStage) {
            $revenueStage[$revStage["id_Revenue_Stage"]] = $revStage["Revenue_Stage"];
        }
        foreach ($cType as $coType) {
            $companyType[$coType["id_Company_Type"]] = $coType["Company_Type"];
        }
        foreach ($csType as $coSuType) {
            $companySubType[$coSuType["id_Company_Sub_Type"]] = $coSuType["Company_Sub_Type_Name"];
        }
        foreach ($pFocus as $prFocus) {
            $productFocus[$prFocus["id_Product_Focus"]] = $prFocus["Product_Focus"];
        }
        foreach ($pfType as $prfFocus) {
            $productFocusType[$prfFocus["id_Product_Focus_Type"]] = $prfFocus["Product_Focus_Type"];
        }
        foreach ($pfsType as $prfsFocus) {
            $productFocusSubType[$prfsFocus["id_Product_Focus_Sub_Type"]] = $prfsFocus["Product_Focus_Sub_Type"];
        }
        foreach ($uParent as $ulParent) {
            $ultimateParent[$ulParent["id_Company"]] = $ulParent["Company_Full_Name"];
        }
        foreach ($cn as $cnt) {
            $country[$cnt["id_Country"]] = $cnt["Country"];
        }

        return compact("employeeSize", "growthProfile", "ownership", "revenueStage", "companyType", "companySubType", "productFocus", "productFocusType",
            "productFocusSubType", "company", "ultimateParent", "mediaContacts", "country", "HQAddresses", "HQPhones");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (isset($request['add_new']) && $request['add_new']) {
            $mediaData = $this->mediaValidator($request);
            Session::set('MediaContacts',Session::get('MediaContacts')->push(new \App\Models\MediaContacts($mediaData)));
            return Redirect::back()->withInput($request->except(["Full_Name_Media_Contact","Media_contact_Email","Media_Contact_Phone"]));
        }


        $address = $this->addressValidator($request);
        $addressModel = Addresses::create($address);
        $phone = $this->phoneValidator($request);
        $phoneModel = Phones::create($phone);

        $companyFields = $this->companyValidator($request);
        $companyFields['Date_Created'] = Carbon::now();
        $companyModel = Companies::create($companyFields);
        $companyModel->mediaContacts()->saveMany(Session::get('MediaContacts'));
        $companyModel->headquaters()->save(new \App\Models\HeadquartersInformation(['PhoneId' => $phoneModel->PhoneId, 'AddressId'=>$addressModel->AddressId]));
        return redirect(route('admin.companies.index'))->with('flash', 'The Company was created');
        //
        //dd($request->all());
    }
    private function mediaValidator(Request $request) {
        $mediaValidator = [
            'Full_Name_Media_Contact' => 'required|string',
            'Media_contact_Email' => 'required|email',
            'Media_Contact_Phone' => 'required|numeric'
        ];
        $this->validate($request,$mediaValidator);
        foreach(array_keys($mediaValidator) as $key){
            $mediaContactFields[$key] = $request[$key];
        }
        return $mediaContactFields;
    }
    private function addressValidator(Request $request) {
        $address = [
            'AddressLine1' => 'required|string',
            'AddressLine2' => 'required|string',
            'City' => 'required|string',
            'State' => 'required|string',
            'id_Country' => 'required|numeric',
            'PostalCode' => 'required|string'
        ];
        $this->validate($request,$address);
        foreach(array_keys($address) as $key){
            $addressFields[$key] = $request[$key];
        }
        return $addressFields;
    }

    private function phoneValidator(Request $request) {
        $phone = ['PhoneNumber' => 'required|string'];
        $this->validate($request,$phone);
        return ['PhoneNumber' => $request['PhoneNumber']];
    }

    private function companyValidator(Request $request) {
        $CompanyValidator = [
            'Company_Full_Name' => 'required|string',
            'Year_Founded' => 'required|numeric',
            'id_Employee_Size' => 'required|numeric',
            'id_Revenue_Stage' => 'required|numeric',
            'id_Growth_Profile' => 'required|numeric',
            'id_Ownership' => 'required|numeric',
            'id_Company_Type' => 'required|numeric',
            'id_Company_Sub_Type' => 'required|numeric',
            'Website' => 'required|url',
            'FinTechMonitor_Company_Code' => 'required',
            'id_Ultimate_Parent' => 'required|numeric',
            'Acquired_Subsidiary' => 'sometimes|accepted',
            'Graduate_Program' => 'sometimes|accepted',
            'Firm_Out_Of_Business' => 'sometimes|accepted',
            'Company_About_Us' => 'required',
            'Company_Description_FTM' => 'required'
        ];
        $this->validate($request,$CompanyValidator);
        foreach(array_keys($CompanyValidator) as $key){
            $companyFields[$key] = $request[$key];
        }
        $companyFields['Date_Modified'] = Carbon::now();
        return $companyFields;
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
        return view("admin.companies.edit", $this->passData($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $company = Companies::findOrFail($id);
        if (isset($request['add_new']) && $request['add_new']) {
            $mediaData = $this->mediaValidator($request);
            $company->mediaContacts()->save(new \App\Models\MediaContacts($mediaData));
            return Redirect::back()->withInput($request->except(["Full_Name_Media_Contact","Media_contact_Email","Media_Contact_Phone"]));
        }
        $address = $this->addressValidator($request);
        $phone = $this->phoneValidator($request);
        if ($company->headquaters()->count()) {
            $company->headquaters()->first()->addresses()->first()->fill($address)->save();
        }
        else {
            $addressModel = Addresses::create($address);

        }
        if ($company->headquaters()->count()){
            $company->headquaters()->first()->phones()->first()->fill($phone)->save();
        }
        else {
            $phoneModel = Phones::create($phone);
        }

        if (!$company->headquaters()->count()) {
            $company->headquaters()->save(new \App\Models\HeadquartersInformation(['PhoneId' => $phoneModel->PhoneId, 'AddressId' => $addressModel->AddressId]));
        }



        $companyFields = $this->companyValidator($request);
        $company->fill($companyFields)->save();
        return redirect(route('admin.companies.index'))->with('flash', 'The Company was updated');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $companies = Companies::findOrFail($id);
        dd($companies);
        return redirect(route('admin.companies.index'));
    }
}
