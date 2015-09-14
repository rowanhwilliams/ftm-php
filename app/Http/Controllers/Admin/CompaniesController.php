<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

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

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $companies = Companies::all(['id_Company','Company_Full_Name','Year_Founded','Website'])->toArray();
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
        if (!is_null($id)){
            $company = Companies::findOrFail($id);
            //$company = $company[0];
            dd($company);
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

        return compact("employeeSize", "growthProfile", "ownership", "revenueStage", "companyType", "companySubType", "productFocus", "productFocusType",
            "productFocusSubType", "company", "ultimateParent");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'Company_Full_Name' => 'required',
            'Year_Founded' => 'required|numeric',
            'id_Employee_Size' => 'required|numeric',
            'id_Revenue_Stage' => 'required|numeric',
            'id_Growth_Profile' => 'required|numeric',
            'id_Ownership' => 'required|numeric',
            'id_Company_Type' => 'required|numeric',
            'id_Company_Sub_Type' => 'required|numeric',
            'Website' => 'required',
            'FinTechMonitor_Company_Code' => 'required',
            'id_Ultimate_Parent' => 'required|numeric',
            'Acquired_Subsidiary' => 'numeric',
            'Graduate_Program' => 'numeric',
            'Firm_Out_Of_Business' => 'numeric',
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'numeric',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'Company_About_Us' => 'required',
            'Company_Description_FTM' => 'required'
        ];

        $this->validate($request,$rules);
        $request->
        $company = Companies::create([$request["Company_Full_Name"],date($request["Year_Founded"]),$request["id_Employee_Size"],$request["id_Revenue_Stage"],$request["id_Growth_Profile"],
            $request["id_Ownership"],$request["id_Company_Type"],$request["id_Company_Sub_Type"],$request["Website"],$request["FinTechMonitor_Company_Code"],$request["id_Ultimate_Parent"],$request["Acquired_Subsidiary"],$request["Graduate_Program"],
            $request["Firm_Out_Of_Business"],$request["Company_About_Us"],$request["Company_Description_FTM"]]);
        return redirect(route('admin.companies.index'));
        //
        //dd($request->all());
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
