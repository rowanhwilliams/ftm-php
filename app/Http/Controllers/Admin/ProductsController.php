<?php

namespace App\Http\Controllers\Admin;

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
        $products = Products::all();
        Session::forget('ProductAttachments');
        Session::forget('ProductAssetsClass');
        Session::forget('ProductTargetMarket');
        Session::forget('ProductTargetEndUser');
        return view("admin.products.index", compact("products"));
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
        if (!is_null($id)) {
            $products = Products::findOrNew($id);
            $cProducts = Products::where("id_Product", "!=", $id)->get()->toArray();
            $attachments = $products->attachments()->get();
            $productTargetMarket = $products->targetMarket()->get();
            $productTargetEndUser = $products->targetEndUser()->get();
            $productAssetClass = $products->assetClass()->get();
            //$territories = $products->territory()->get();
        }
        else {
            $products = new \App\Models\Products();
            $cProducts = Products::all()->toArray();
            if (!Session::has('ProductAttachments')) {
                Session::set('ProductAttachments', $products->attachments()->get());
            }
            $attachments = Session::get("ProductAttachments");

//            if (!Session::has('ProductTerritory')) {
//                Session::set('ProductTerritory', $products->territory()->get());
//            }
//            $territories = Session::get("ProductTerritory");

            if (!Session::has('ProductAssetsClass')) {
                Session::set('ProductAssetsClass', $products->assetClass()->get());
            }
            $productAssetClass = Session::get("ProductAssetsClass");

            if (!Session::has('ProductTargetMarket')) {
                Session::set('ProductTargetMarket', $products->targetMarket()->get());
            }
            $productTargetMarket = Session::get("ProductTargetMarket");

            if (!Session::has('ProductTargetEndUser')) {
                Session::set('ProductTargetEndUser', $products->targetEndUser()->get());
            }
            $productTargetEndUser = Session::get("ProductTargetEndUser");
        }

        $comps = Companies::all(["id_Company","Company_Full_Name"])->sortBy('Company_Full_Name')->toArray();
        $prType = ProductType::all()->toArray();
        $pFocus = ProductFocus::all();
        $pfType = ProductFocusType::where("id_Product_Focus", "=", $products->id_Product_Focus ? $products->id_Product_Focus : 1)->get()->toArray();
        $pfsType = ProductFocusSubType::where("id_Product_Focus_Type", "=", $products->id_Product_Focus_Type ? $products->id_Product_Focus_Type : 1)->get()->toArray();
        $tMarket  = TargetMarket::all()->toArray();
        $tEndUser = TargetEndUser::all()->toArray();
        $cAssets = AssetClass::all()->toArray();
        $pRegions = Region::all()->toArray();
        $pPos = Positions::all()->toArray();


        foreach ($prType as $pType){
            $productType[$pType["id_Product_Type"]] = $pType["Product_Type"];
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
        foreach ($comps as $comp) {
            $companies[$comp["id_Company"]] = $comp["Company_Full_Name"];
        }
        foreach ($tMarket as $tgMarket) {
            $targetMarket[$tgMarket["id_Target_Market"]] = $tgMarket["Target_Market"];
        }
        foreach ($tEndUser as $tgEndUser) {
            $targetEndUser[$tgEndUser["id_Target_End_User"]] = $tgEndUser["Target_End_User"];
        }
        foreach ($cAssets as $clAssets) {
            $assetClass[$clAssets["id_Asset_Class"]] = $clAssets["Asset_Class"];
        }
        foreach ($cProducts as $cpProducts) {
            $competitorProducts[$cpProducts["id_Product"]] = $cpProducts["Product_Title"];
        }
        foreach ($pRegions as $prRegions) {
            $regions[$prRegions["id_Region"]] = $prRegions["Region"];
        }
        foreach ($pPos as $prPos) {
            $positions[$prPos["id_Position"]] = $prPos["Position_Name"];
        }

        return compact("productType", "productFocus", "productFocusType", "productFocusSubType", "companies", "targetMarket",
            "targetEndUser","assetClass", "products", "competitorProducts", "regions", "positions", "attachments",
            "productTargetEndUser", "productTargetMarket", "productAssetClass", "territories");
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
            'product_availability_teritory' => 'required|numeric'
        ];

        $this->validate($request, $territoryValidator);
        return ["product_availability_teritory" => $request->product_availability_teritory];
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
            'id_Product_Type' => 'required|numeric',
            'First_Launched' => 'required|numeric',
            'id_Product_Focus' => 'required|numeric',
            'id_Product_Focus_Type' => 'required|numeric',
            'id_Product_Focus_Sub_Type' => 'required|numeric',
            'FTM_Product_Description' => 'required|string'
        ];
        $this->validate($request, $productsValidator);
        foreach(array_keys($productsValidator) as $key){
            $productsFields[$key] = $request[$key];
        }
        $productsFields['Date_Modified'] = Carbon::now();
        return $productsFields;
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
        if (isset($request['add_target_end_user']) && $request['add_target_end_user']) {
            $tergetEndUserField = $this->addTargetEndUserValidator($request);
            Session::set('ProductTargetEndUser', Session::get('ProductTargetEndUser')->push(TargetEndUser::findOrNew($tergetEndUserField["id_Target_End_User"])));
            return Redirect::back()->withInput($request->except(["add_target_end_user"]));
        }
        if (isset($request['add_target_market']) && $request['add_target_market']) {
            $tergetEndUserField = $this->addTargetMarketValidator($request);
            Session::set('ProductTargetMarket', Session::get('ProductTargetMarket')->push(TargetMarket::findOrNew($tergetEndUserField["id_Target_Market"])));
            return Redirect::back()->withInput($request->except(["add_target_market"]));
        }

        $productsFields = $this->productValidator($request);
        $productsFields['Date_Created'] = Carbon::now();
        $productsModel = Products::create($productsFields);
        foreach(Session::get('CompanyAttachments') as $atts){
            $productsModel->attachments()->save($atts);
        }
        foreach(Session::get('ProductAssetsClass') as $assetClass) {
            $productsModel->assetClass()->save($assetClass);
        }
        foreach(Session::get('ProductTargetEndUser') as $endUserTrg) {
            $productsModel->targetEndUser()->save($endUserTrg);
        }
        foreach(Session::get('ProductTargetMarket') as $marketTrg) {
            $productsModel->targetMarket()->save($marketTrg);
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
        //
    }
}
