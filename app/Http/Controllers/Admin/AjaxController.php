<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProductFocusType;
use App\Models\ProductFocusSubType;


class AjaxController extends Controller
{
    public function productFocusType($focus) {
        return ProductFocusType::where("id_Product_Focus", "=", $focus)->get(["id_Product_Focus_Type","Product_Focus_Type"])->toJson();
    }
    public function productFocusSubType($focusType){
        return ProductFocusSubType::where("id_Product_Focus_Type", "=", $focusType)->get(["id_Product_Focus_Sub_Type","Product_Focus_Sub_Type"])->toJson();

    }
}
