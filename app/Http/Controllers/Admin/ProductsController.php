<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        }
        else {
            $products = new \App\Models\Products();
        }

        $comps = Companies::all(["id_Company","Company_Full_Name"])->toArray();
        $prType = ProductType::all()->toArray();
        $pFocus = ProductFocus::all();
        $pfType = ProductFocusType::where("id_Product_Focus", "=", "1")->get()->toArray();
        $pfsType = ProductFocusSubType::where("id_Product_Focus_Type", "=", "1")->get()->toArray();
        $tMarket  = TargetMarket::all()->toArray();
        $tEndUser = TargetEndUser::all()->toArray();
        $cAssets = AssetClass::all()->toArray();

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

        return compact("productType", "productFocus", "productFocusType", "productFocusSubType", "companies", "targetMarket",
            "targetEndUser","assetClass", "products");
    }

    private function productValidator(Request $request) {

        $productsValidator = [
            'Product_Title' => 'required|string',
            'id_Owner_Company' => 'required|numeric',
            'id_Product_Type' => 'required|numeric',
            'First_Launched' => 'required|numeric',
            'id_Target_Market' => 'required|numeric',
            'id_Target_End_User' => 'required|numeric',
            'id_Asset_Class' => 'required|numeric',
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
        $productsFields = $this->productValidator($request);
        $productsFields['Date_Created'] = Carbon::now();
        $productsModel = Products::create($productsFields);
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
