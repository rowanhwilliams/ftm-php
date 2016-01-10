<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addresses;
use App\Models\Phones;
use App\Models\Products;
use App\Models\Search;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
use App\Models\Country;
use App\Models\ProductFocusType;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index(Request $request)
    {
        $searchFilters = ["Company_Full_Name"];
        $paginationList  = [];
        
        $activePage = $request->page ? $request->page : null;

        $companiesSearchBy = Companies::getCompaniesSearchBy();
        $companiesList = DB::table('Company')
            ->where("Deleted", "=", NULL)
            ->orderBy('Company_Full_Name', 'asc');

        foreach($companiesList->get() as $company)
        {
            if (strlen($company->Company_Full_Name)) {
                $firstChar = strtolower(substr($company->Company_Full_Name, 0, 1));
                if(!isset($paginationList[$firstChar]))
                {
                    $paginationList[$firstChar] = 0;
                }
                $paginationList[$firstChar] += 1;
            }
        }

        $companies = DB::table('Company')
            ->select('Company.id_Company','Company.Company_Full_Name','Company.Year_Founded','Company.Website','Company.id_Employee_Size',
                     'Employee_Size.Employee_Size', 'Addresses.City', 'Addresses.State', 'Country.Country','Revenue_Stage.Revenue_Stage')
            ->leftJoin('Employee_Size', 'Company.id_Employee_Size', '=', 'Employee_Size.id_Employee_Size')
            ->leftJoin('Headquarters_Information', 'Company.id_Company', '=', 'Headquarters_Information.id_Company')
            ->leftJoin('Addresses', 'Headquarters_Information.AddressId', '=', 'Addresses.AddressId')
            ->leftJoin('Country', 'Addresses.id_Country', '=', 'Country.id_Country')
            ->leftJoin('Revenue_Stage', 'Company.id_Revenue_Stage', '=', 'Revenue_Stage.id_Revenue_Stage')
            ->whereNull("Deleted")
            ->groupBy("Headquarters_Information.AddressId")
            ->groupBy("Company.id_Company")
            ->orderBy('Company_Full_Name', 'asc');

        if (!is_null($activePage) && $activePage != "all")
        {
            $companies->where("Company_Full_Name", "like", "$activePage%");
        }


        //$products = Products::all();
        $products = Products::whereNull("Deleted")->get();
        $employeeSize = EmployeeSize::all();
        $ProductsToShow = [];
        $ProductsToHide = [];
        foreach ($companies->get() as $company) {
            $ProductsToShow[$company->id_Company] = [];
            $ProductsToHide[$company->id_Company] = [];
            $itemQty = 0;
            foreach ($products as $product) {
                if ($product->id_Owner_Company == $company->id_Company)
                {
                    $itemQty++;
                    if ($itemQty > 1) {
                        $ProductsToHide[$company->id_Company][] = ["id" => $product->id_Product, "title" => $product->Product_Title];
                        //link_to(URL::route("admin.products.edit", $product->id_Product), $product->Product_Title, ["target"=>"_blank"]);
                    }
                    else {
                        $ProductsToShow[$company->id_Company][] = ["id" => $product->id_Product, "title" => $product->Product_Title];
                    }
                }
            }
        }
        //$companies = Paginator::make($companies, $companies->count(), 15);
        // empty session data
        Session::forget('CompanySearch');
        Session::forget('SearchFilters');
        Session::forget('MediaContacts');
        Session::forget('CompanyAttachments');
        return view("admin.companies.index", compact('companies', "ProductsToHide", "ProductsToShow", "search", "employeeSize", "searchFilters",
                    "paginationList", "activePage", "companiesSearchBy"));
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

    public function search(Request $request)
    {
        $paginationList = [];

        //$this->validate($request, Search::getValidatorRules());

        $searchFilters = Companies::getCompaniesSearchBy();
        $search = $request->get("search") ? $request->get("search") : Session::get('CompanySearch');

        Session::set('CompanySearch', $search);

        $companiesList = DB::table('Company')
                ->where("Deleted", "=", NULL)
                ->orderBy('Company_Full_Name', 'asc');
        if (count($searchFilters)) {
            $companiesList->where(
                function ($query) use ($searchFilters, $search) {
                    foreach($searchFilters as $searchFilter)
                    {
                        $query->where($searchFilter, 'like', "%$search%", "OR");
                    }
                }
            );
        }

        if ($companiesList->count()) {
            foreach($companiesList->get() as $company)
            {
                if (strlen($company->Company_Full_Name)) {
                    $firstChar = strtolower(substr($company->Company_Full_Name, 0, 1));
                    if(!isset($paginationList[$firstChar]))
                    {
                        $paginationList[$firstChar] = 0;
                    }
                    $paginationList[$firstChar] += 1;
                }
            }
            $activePage = $request->page ? $request->page : null;
            $companies = DB::table('Company')
                ->select('Company.id_Company','Company.Company_Full_Name','Company.Year_Founded','Company.Website','Company.id_Employee_Size',
                    'Employee_Size.Employee_Size', 'Addresses.City', 'Addresses.State', 'Country.Country', 'Revenue_Stage.Revenue_Stage')
                ->leftJoin('Employee_Size', 'Company.id_Employee_Size', '=', 'Employee_Size.id_Employee_Size')
                ->leftJoin('Headquarters_Information', 'Company.id_Company', '=', 'Headquarters_Information.id_Company')
                ->leftJoin('Addresses', 'Headquarters_Information.AddressId', '=', 'Addresses.AddressId')
                ->leftJoin('Country', 'Addresses.id_Country', '=', 'Country.id_Country')
                ->leftJoin('Revenue_Stage', 'Company.id_Revenue_Stage', '=', 'Revenue_Stage.id_Revenue_Stage')
                ->whereNull("Deleted")
                ->groupBy("Headquarters_Information.AddressId")
                ->groupBy("Company.id_Company")
                ->orderBy('Company_Full_Name', 'asc');

            if (count($searchFilters)) {
                $companies->where(function ($query) use ($searchFilters, $search) {
                    foreach($searchFilters as $searchFilter)
                    {
                        $query->where($searchFilter, 'like', "%$search%", "OR");
                    }
                });
            }

            if (!is_null($activePage) && $activePage != "all")
            {
                $companies->where("Company_Full_Name", "like", "$activePage%");
            }
        }
        else {
            $companies = $companiesList;
            $activePage = "";
        }

        //$products = Products::whereNull("Deleted");
        $products = Products::whereNull("Deleted")->get();
        $employeeSize = EmployeeSize::all();
        $ProductsToShow = [];
        $ProductsToHide = [];
        foreach ($companies->get() as $company) {
            $ProductsToShow[$company->id_Company] = [];
            $ProductsToHide[$company->id_Company] = [];
            $itemQty = 0;
            foreach ($products as $product) {
                if ($product->id_Owner_Company == $company->id_Company)
                {
                    $itemQty++;
                    if ($itemQty > 1) {
                        $ProductsToHide[$company->id_Company][] = ["id" => $product->id_Product, "title" => $product->Product_Title];
                        //link_to(URL::route("admin.products.edit", $product->id_Product), $product->Product_Title, ["target"=>"_blank"]);
                    }
                    else {
                        $ProductsToShow[$company->id_Company][] = ["id" => $product->id_Product, "title" => $product->Product_Title];
                    }
                }
            }
        }
        $employeeSize = EmployeeSize::all();
        return view("admin.companies.index", compact('companies', "products", "search", "employeeSize","searchFilters",
                    "paginationList", "activePage","companiesSearchBy", "ProductsToHide", "ProductsToShow"));
    }

    private function passData($id = null)
    {
        $HQAddresses = new \App\Models\Addresses();
        $HQPhones = new \App\Models\Phones();
        $company = new \App\Models\Companies();
        if (!is_null($id)) {
            $company = Companies::findOrNew($id);
            $mediaContacts = $company->mediaContacts()->get();
            $attachments = $company->attachments()->get();
        }
        else {
            if (!Session::has('MediaContacts')) {
                Session::set('MediaContacts', $company->mediaContacts()->get());
            }
            if (!Session::has('CompanyAttachments')) {
                Session::set('CompanyAttachments', $company->attachments()->get());
            }
            $mediaContacts = Session::get('MediaContacts');
            $attachments = Session::get("CompanyAttachments");
        }

        $eSize = EmployeeSize::all()->toArray();
        $gProfile = GrowthProfile::where('id_Growth_Profile', '>', 1)->get()->toArray();
        $oship = Ownership::all()->toArray();
        $rStage = RevenueStage::where('id_Revenue_Stage', '>', 1)->get()->toArray();
        $cType = CompanyType::all()->toArray();
        $csType = CompanySubType::all()->toArray();
        $uParent = Companies::where("Deleted", "=", NULL)->get()->sortBy('Company_Full_Name')->toArray();
        $products = $company->products()->whereNull("Deleted");
        foreach($products->get() as $product) {
            $productFocusTypeList[$product->id_Product] = [];
            $productTypeList = [];
            foreach($product->focusSubType()->get() as $productSubType) {
                $productTypeList[0] = $productSubType->Product_Focus_Sub_Type;
                $productTypeListValues = ProductFocusType::where('id_Product_Focus_Type', '=', $productSubType->id_Product_Focus_Type)->get()->first();
                $productTypeList[1] = $productTypeListValues->Product_Focus_Type;
                $productFocusTypeList[$product->id_Product][] = $productTypeList;
            }

        }


        if ($company->headquaters()->get()->count()) {
            $HQAddresses = Addresses::findOrNew($company->headquaters()->get()->first()->AddressId);
        }

        if ($company->headquaters()->get()->count() && $company->headquaters()->get()->first()->PhoneId){
            $HQPhones = Phones::findOrNew($company->headquaters()->get()->first()->PhoneId);
        }

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
        foreach ($uParent as $ulParent) {
            $ultimateParent[$ulParent["id_Company"]] = $ulParent["Company_Full_Name"];
        }
        $country = Country::getListCountries();

        return compact("employeeSize", "growthProfile", "productFocusTypeList", "ownership", "revenueStage", "companyType", "companySubType",
            "company", "ultimateParent", "mediaContacts", "country", "HQAddresses", "HQPhones", "products", "attachments");
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
            Session::set('MediaContacts', Session::get('MediaContacts')->push(new \App\Models\MediaContacts($mediaData)));
            return Redirect::back()->withInput($request->except(["Full_Name_Media_Contact","Media_contact_Email","Media_Contact_Phone"]));
        }
        else if (isset($request['attach_file']) && $request['attach_file']) {
            $attachmentFields = $this->attachFileValidator($request);
            Session::set('CompanyAttachments', Session::get('CompanyAttachments')->push(new \App\Models\Attachments($attachmentFields)));
            return Redirect::back()->withInput($request->except(["attached_file"]));
        }

        $address = $this->addressValidator($request);
        $addressModel = Addresses::create($address);
        $phone = $this->phoneValidator($request);
        $phoneModel = Phones::create($phone);

        $companyFields = $this->companyValidator($request);
        $companyFields['Date_Created'] = Carbon::now();
        $companyModel = Companies::create($companyFields);
        $companyModel->mediaContacts()->saveMany(Session::get('MediaContacts'));
        foreach(Session::get('CompanyAttachments') as $atts){
            $companyModel->attachments()->save($atts);
        }

        $companyModel->headquaters()->save(new \App\Models\HeadquartersInformation(['PhoneId' => $phoneModel->PhoneId,
            'AddressId'=>$addressModel->AddressId]));
        return redirect(route('admin.companies.index'))->with('flash', 'The Company was created');
    }
    private function StoreAttachment($parentID, Request $request) {
        $AttachmentFieldsData = [];
        Storage::makeDirectory("C_".$parentID);
        Storage::disk("local")->put("C_".$parentID."/".$request->files->get("attached_file")->getClientOriginalName(),
            file_get_contents($request->file("attached_file")));
        $AttachmentFieldsData["Attachment_Storage_File_Name"] = $request->files->get("attached_file")->getClientOriginalName();
        return $AttachmentFieldsData;
    }
    private function attachFileValidator(Request $request){
        $fileValidator = [
            'attached_file' => 'required|mimes:png,gif,jpeg,pdf,doc,rtf,xls|max:2048'
        ];

        $this->validate($request, $fileValidator);
        $AttachmentFields = $this->StoreAttachment($request->_token, $request);
        return ["Attachment_File_Name" => $request->files->get("attached_file")->getClientOriginalName(),
            "Attachment_Storage_File_Name"=>$AttachmentFields["Attachment_Storage_File_Name"]];
    }
    private function mediaValidator(Request $request) {
        $mediaValidator = [
            'Full_Name_Media_Contact' => 'required|string',
            'Media_contact_Email' => 'required|email',
            'Media_Contact_Phone' => 'required|string'
        ];
        $this->validate($request,$mediaValidator);
        foreach(array_keys($mediaValidator) as $key){
            $mediaContactFields[$key] = $request[$key];
        }
        return $mediaContactFields;
    }
    private function addressValidator(Request $request) {
        $address = [
            'AddressLine1' => 'string',
            'AddressLine2' => 'string',
            'City' => 'string',
            'State' => 'string',
            'id_Country' => 'required|numeric',
            'PostalCode' => 'string'
        ];
        $this->validate($request,$address);
        foreach(array_keys($address) as $key){
            $addressFields[$key] = $request[$key];
        }
        return $addressFields;
    }

    private function phoneValidator(Request $request) {
        $phone = ['PhoneNumber' => 'string'];
        $this->validate($request,$phone);
        return ['PhoneNumber' => $request['PhoneNumber']];
    }

    private function companyValidator(Request $request) {
        $CompanyValidator = [
            'Company_Full_Name' => 'required|string',
            'Year_Founded' => 'numeric',
            'id_Employee_Size' => 'required|numeric',
            'id_Revenue_Stage' => 'required|numeric',
            'id_Growth_Profile' => 'required|numeric',
            'id_Ownership' => 'required|numeric',
            'id_Company_Type' => 'required|numeric',
            'id_Company_Sub_Type' => 'required|numeric',
            'Website' => 'required|url',
            'id_Ultimate_Parent' => 'required|numeric',
            'Acquired_Subsidiary' => 'sometimes|accepted',
            'Graduate_Program' => 'sometimes|accepted',
            'Firm_Out_Of_Business' => 'sometimes|accepted',
            'Company_About_Us' => 'string',
            'Company_Description_FTM' => 'string'
        ];
        $this->validate($request,$CompanyValidator);
        foreach(array_keys($CompanyValidator) as $key){
            $companyFields[$key] = $request[$key];
        }
        $companyFields['Date_Modified'] = Carbon::now();
        return $companyFields;
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
        else if (isset($request['attach_file']) && $request['attach_file']) {
            $attachmentFields = $this->attachFileValidator($request);
            $company->attachments()->save(new \App\Models\Attachments($attachmentFields));
            return Redirect::back()->withInput($request->except(["attached_file"]));
        }
        $address = $this->addressValidator($request);
        $phone = $this->phoneValidator($request);
        if ($company->headquaters()->get()->count()) {
            Addresses::findOrNew($company->headquaters()->first()->AddressId)->fill($address)->save();
        }
        else {
            $addressModel = Addresses::create($address);

        }
        if ($company->headquaters()->get()->count()){
            Phones::findOrNew($company->headquaters()->first()->PhoneId)->fill($phone)->save();
        }
        else {
            $phoneModel = Phones::create($phone);
        }

        if (!$company->headquaters()->count()) {
            $company->headquaters()->save(new \App\Models\HeadquartersInformation(['PhoneId' => $phoneModel->PhoneId, 'AddressId' => $addressModel->AddressId]));
        }



        $companyFields = $this->companyValidator($request);
        $company->fill($companyFields)->save();
        return redirect(route('admin.companies.index'))->with('flash', 'The Company was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $company = Companies::findOrFail($id);
        $company->fill(["Deleted" => Carbon::now()])->save();
        return redirect(route('admin.companies.index'));
    }
}
