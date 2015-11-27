<?php

namespace App\Http\Controllers\Admin;

use App\Models\AvailabilityTerritory;
use App\Models\CompetitorProduct;
use App\Models\Positions;
use App\Models\Products;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Models\ProductFocus;
use App\Models\ProductFocusType;
use App\Models\ProductFocusSubType;
use App\Models\Companies;
use App\Models\TargetMarket;
use App\Models\TargetEndUser;
use App\Models\AssetClass;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Products::where("Deleted", "=", NULL)->get()->sortBy("Product_Title");;
        Session::forget('ProductAttachments');
        Session::forget('ProductCompetitors');
        Session::forget('ProductFocusSubType');
        $productFocusSubTypeList = [];
        $productFocusTypeList = [];
        $productOwnerList = [];
        foreach($products as $product) {
            $productSubTypeList = [];
            $productTypeList = [];
            $productOwnerList[$product->id_Product] = Companies::where('id_Company', '=', $product->id_Owner_Company)->get()->first();
            foreach($product->focusSubType()->get() as $productSubType) {
                $productSubTypeList[] = $productSubType->Product_Focus_Sub_Type;
                $productTypeListValues = ProductFocusType::where('id_Product_Focus_Type', '=', $productSubType->id_Product_Focus_Type)->get()->first();
                $productTypeList[] = $productTypeListValues->Product_Focus_Type;
            }

            $productFocusSubTypeList[$product->id_Product] = implode(',', $productSubTypeList);
            $productFocusTypeList[$product->id_Product] = implode(',', $productTypeList);

        }
        return view("admin.products.index", compact("products", "productFocusSubTypeList", "productFocusTypeList", "productOwnerList"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.products.create", $this->passData());
    }

    private function passData($id = null) {
        $products = new \App\Models\Products();

        if (!is_null($id)) {
            $products = Products::findOrNew($id);
        }

        if (!is_null($id)) {

            $cProducts = Products::where("id_Product", "!=", $id)->get()->toArray();
            $attachments = $products->attachments()->get();
            $productFocusSubTypeList = $products->focusSubType()->get();
            $productCompetitors = $products->competitor()->get();
        }
        else {
            $cProducts = Products::all()->toArray();
            if (!Session::has('ProductAttachments')) {
                Session::set('ProductAttachments', $products->attachments()->get());
            }
            $attachments = Session::get("ProductAttachments");
            if (!Session::has('ProductFocusSubType')) {
                Session::set('ProductFocusSubType', $products->focusSubType()->get());
            }
            $productFocusSubTypeList = Session::get("ProductFocusSubType");

            if (!Session::has('ProductCompetitors')) {
                Session::set('ProductCompetitors', $products->competitor()->get());
            }
            $productCompetitors = Session::get("ProductCompetitors");

        }

        $pFocus = ProductFocus::all();
        $pfType = ProductFocusType::where("id_Product_Focus", "=", $products->id_Product_Focus ? $products->id_Product_Focus : 1)->get()->toArray();
        $pfsType = ProductFocusSubType::where("id_Product_Focus_Type", "=", $products->id_Product_Focus_Type ? $products->id_Product_Focus_Type : 1)->get()->toArray();
        $pPos = Positions::all()->toArray();
        $competitorProducts = [];

        foreach ($pFocus as $prFocus) {
            $productFocus[$prFocus["id_Product_Focus"]] = $prFocus["Product_Focus"];
        }
        foreach ($pfType as $prfFocus) {
            $productFocusType[$prfFocus["id_Product_Focus_Type"]] = $prfFocus["Product_Focus_Type"];
        }
        foreach ($pfsType as $prfsFocus) {
            $productFocusSubType[$prfsFocus["id_Product_Focus_Sub_Type"]] = $prfsFocus["Product_Focus_Sub_Type"];
        }
        foreach ($cProducts as $cpProducts) {
            $competitorProducts[$cpProducts["id_Product"]] = $cpProducts["Product_Title"];
        }
        foreach ($pPos as $prPos) {
            $positions[$prPos["id_Position"]] = $prPos["Position_Name"];
        }

        $Companies = Companies::SelectOptionsModel();
        $TargetEndUser = TargetEndUser::CheckboxesModel();
        $TargetMarket = TargetMarket::CheckboxesModel();
        $AssetClass = AssetClass::CheckboxesModel();
        $AvailabilityTerritory = AvailabilityTerritory::CheckboxesModel();

        $TargetEndUserSelection = $products->TargetEndUserSelection();
        $TargetMarketSelection = $products->TargetMarketSelection();
        $ClassAssetsSelection = $products->ClassAssetsSelection();
        $TerritorySelection = $products->TerritorySelection();

        return compact("products", "productFocus", "productFocusType", "productFocusSubType", "Companies", "TargetMarket",
            "TargetEndUser","AssetClass", "competitorProducts", "AvailabilityTerritory", "positions", "attachments",
            "TerritorySelection", "TargetEndUserSelection", "TargetMarketSelection", "ClassAssetsSelection", "productFocusSubTypeList",
            "productCompetitors");
    }

    private function StoreAttachment($parentID, Request $request) {
        $AttachmentFieldsData = [];
        Storage::makeDirectory("P_".$parentID);
        Storage::disk("local")->put("P_".$parentID."/".$request->files->get("attached_file")->getClientOriginalName(),
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
    // Target Territory validator
    private function addTerritoryValidator(Request $request) {
        $territoryValidator = [
            'id_Availability_Territory' => 'required|numeric'
        ];

        $this->validate($request, $territoryValidator);
        return ["id_Availability_Territory" => $request->id_Availability_Territory];
    }
    // Target Asset Class validator
    private function addClassAssetsValidator(Request $request) {
        $classAssetsValidator = [
            'id_Asset_Class' => 'required|numeric'
        ];

        $this->validate($request, $classAssetsValidator);
        return ["id_Asset_Class" => $request->id_Asset_Class];
    }
    // Target end user validator
    private function addTargetEndUserValidator(Request $request) {
        $classAssetsValidator = [
            'id_Target_End_User' => 'required|numeric'
        ];

        $this->validate($request, $classAssetsValidator);
        return ["id_Target_End_User" => $request->id_Target_End_User];
    }
    // Target end user validator
    private function addProducFocusSubTypeValidator(Request $request) {
        $classFocusSubTypeValidator = [
            'id_Product_Focus_Sub_Type' => 'required|numeric'
        ];

        $this->validate($request, $classFocusSubTypeValidator);
        return ["id_Product_Focus_Sub_Type" => $request->id_Product_Focus_Sub_Type];
    }
    // Target market validator
    private function addTargetMarketValidator(Request $request) {
        $classAssetsValidator = [
            'id_Target_Market' => 'required|numeric'
        ];

        $this->validate($request, $classAssetsValidator);
        return ["id_Target_Market" => $request->id_Target_Market];
    }

    private function productValidator(Request $request) {

        $productsValidator = [
            'Product_Title' => 'required|string',
            'id_Owner_Company' => 'required|numeric',
            'id_Key_Decision_Maker' => 'required|numeric',
            'First_Launched' => 'required|numeric',
            'FTM_Product_Description' => 'required|string'
        ];
        $this->validate($request, $productsValidator);
        foreach(array_keys($productsValidator) as $key){
            $productsFields[$key] = $request[$key];
        }
        $productsFields['Date_Modified'] = Carbon::now();
        return $productsFields;
    }

    private function addCompetitorProductValidator(Request $request) {
        $ProductCompatitorValidator = [
            'id_Competitor_Product' => 'required|numeric'
        ];
        $this->validate($request, $ProductCompatitorValidator);
        return ["id_Competitor_Product" => $request->id_Competitor_Product];
    }

    private function ListTargetEndUser(Request $request)
    {
        $targetEndUserList = [];
        $targetEndUserModel = TargetEndUser::getTargetEndUserCheckboxesModel();
        foreach($targetEndUserModel as $targetEndUser)
        {
            if ($request->{$targetEndUser->name} == "on")
            {
                $targetEndUserList[] = (integer) str_replace("Target_End_User_", "", $targetEndUser->name);
            }
        }
        return $targetEndUserList;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (isset($request['attach_file']) && $request['attach_file']) {
            $attachmentFields = $this->attachFileValidator($request);
            Session::set('ProductAttachments', Session::get('ProductAttachments')->push(new \App\Models\Attachments($attachmentFields)));
            return Redirect::back()->withInput($request->except(["attached_file"]));
        }
        if (isset($request['add_asset_class']) && $request['add_asset_class']) {
            $assetClassField = $this->addClassAssetsValidator($request);
            Session::set('ProductAssetsClass', Session::get('ProductAssetsClass')->push(AssetClass::findOrNew($assetClassField["id_Asset_Class"])));
            return Redirect::back()->withInput($request->except(["add_asset_class"]));
        }
//        if (isset($request['add_target_end_user']) && $request['add_target_end_user']) {
//            $tergetEndUserField = $this->addTargetEndUserValidator($request);
//            Session::set('ProductTargetEndUser', Session::get('ProductTargetEndUser')->push(TargetEndUser::findOrNew($tergetEndUserField["id_Target_End_User"])));
//            return Redirect::back()->withInput($request->except(["add_target_end_user"]));
//        }
//        if (isset($request['add_target_market']) && $request['add_target_market']) {
//            $tergetEndUserField = $this->addTargetMarketValidator($request);
//            Session::set('ProductTargetMarket', Session::get('ProductTargetMarket')->push(TargetMarket::findOrNew($tergetEndUserField["id_Target_Market"])));
//            return Redirect::back()->withInput($request->except(["add_target_market"]));
//        }
        if (isset($request['add_teritory']) && $request['add_teritory']) {
            $territoryField = $this->addTerritoryValidator($request);
            Session::set('ProductTerritory', Session::get('ProductTerritory')->push(AvailabilityTerritory::findOrNew($territoryField["id_Availability_Territory"])));
            return Redirect::back()->withInput($request->except(["add_teritory"]));
        }
        if (isset($request['add_Product_Focus_Sub_type']) && $request['add_Product_Focus_Sub_type']) {
            $producFocusSubTypeField = $this->addProducFocusSubTypeValidator($request);
            Session::set('ProductFocusSubType', Session::get('ProductFocusSubType')->
                push(ProductFocusSubType::findOrNew($producFocusSubTypeField["id_Product_Focus_Sub_Type"])));
            return Redirect::back()->withInput($request->except(["add_Product_Focus_Sub_type"]));
        }
        if (isset($request['add_competitor']) && $request['add_competitor']) {
            $competitorProductField = $this->addCompetitorProductValidator($request);
            Session::set('ProductCompetitors', Session::get('ProductCompetitors')->push(Products::findOrNew($competitorProductField['id_Competitor_Product'])));
            return Redirect::back()->withInput($request->except(["add_competitor"]));
        }

        $targetEndUser = $this->ListTargetEndUser($request);
        $productsFields = $this->productValidator($request);
        $productsFields['Date_Created'] = Carbon::now();
        $productsModel = Products::create($productsFields);

        foreach(Session::get('ProductAttachments') as $atts){
            $productsModel->attachments()->save($atts);
        }
        foreach(Session::get('ProductAssetsClass') as $assetClass) {
            $productsModel->assetClass()->save($assetClass);
        }
        foreach($targetEndUser as $endUserTrgId) {
            $productsModel->targetEndUser()->save(TargetEndUser::findOrNew($endUserTrgId));
        }
        foreach(Session::get('ProductTargetMarket') as $marketTrg) {
            $productsModel->targetMarket()->save($marketTrg);
        }
        foreach(Session::get('ProductTerritory') as $territory) {
            $productsModel->territory()->save($territory);
        }
        foreach(Session::get('ProductFocusSubType') as $focusSubType) {
            $productsModel->focusSubType()->save($focusSubType);
        }
        foreach(Session::get('ProductCompetitors') as $productCompetitors) {
            $productsModel->competitor()->save($productCompetitors);
        }

        return redirect(route('admin.products.index'))->with('flash', 'The Product was created');
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
        return view("admin.products.edit", $this->passData($id));
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
        $productModel = Products::findOrFail($id);
        if (isset($request['attach_file']) && $request['attach_file']) {
            $attachmentFields = $this->attachFileValidator($request);
            $productModel->attachments()->save(new \App\Models\Attachments($attachmentFields));
            return Redirect::back()->withInput($request->except(["attached_file"]));
        }

        if (isset($request['add_asset_class']) && $request['add_asset_class']) {
            $assetClassField = $this->addClassAssetsValidator($request);
            $productModel->assetClass()->save(AssetClass::findOrNew($assetClassField["id_Asset_Class"]));
            return Redirect::back()->withInput($request->except(["add_asset_class"]));
        }
        if (isset($request['add_target_end_user']) && $request['add_target_end_user']) {
            $tergetEndUserField = $this->addTargetEndUserValidator($request);
            $productModel->targetEndUser()->save(TargetEndUser::findOrNew($tergetEndUserField["id_Target_End_User"]));
            return Redirect::back()->withInput($request->except(["add_target_end_user"]));
        }
        if (isset($request['add_target_market']) && $request['add_target_market']) {
            $tergetEndUserField = $this->addTargetMarketValidator($request);
            $productModel->targetMarket()->save(TargetMarket::findOrNew($tergetEndUserField["id_Target_Market"]));
            return Redirect::back()->withInput($request->except(["add_target_market"]));
        }
        if (isset($request['add_teritory']) && $request['add_teritory']) {
            $territoryField = $this->addTerritoryValidator($request);
            $productModel->territory()->save(AvailabilityTerritory::findOrNew($territoryField["id_Availability_Territory"]));
            return Redirect::back()->withInput($request->except(["add_teritory"]));
        }
        if (isset($request['add_Product_Focus_Sub_type']) && $request['add_Product_Focus_Sub_type']) {
            $producFocusSubTypeField = $this->addProducFocusSubTypeValidator($request);
            $productModel->focusSubType()->save(ProductFocusSubType::findOrNew($producFocusSubTypeField["id_Product_Focus_Sub_Type"]));
            return Redirect::back()->withInput($request->except(["add_Product_Focus_Sub_type"]));
        }
        if (isset($request['add_competitor']) && $request['add_competitor']) {
            $competitorProductField = $this->addCompetitorProductValidator($request);
            $productModel->competitor()->save(Products::findOrNew($competitorProductField['id_Competitor_Product']));
            return Redirect::back()->withInput($request->except(["add_competitor"]));
        }
        dd($productModel->targetEndUser()->where("id_Target_End_User", "=", $productModel->id_Product)->delete());
        $productsFields = $this->productValidator($request);
        $productModel->fill($productsFields)->save();
        return redirect(route('admin.products.index'))->with('flash', 'The Product was updated');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->fill(["Deleted" => Carbon::now()])->save();
        return redirect(route('admin.products.index'));
    }
}
