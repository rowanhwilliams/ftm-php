<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\JobType;
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
    public function jobTypeByJobFamily($jobFamily){
        return JobType::where("id_Job_Family", "=", $jobFamily)->get()->toJson();
    }
    public function getCoutryByRegion($regionId)
    {
        $countries = [];
        foreach(Country::getCountriesOptionsByRegion($regionId) as $index=>$country)
        {
            $localObject = new \stdClass();
            $localObject->id_Country = $index;
            $localObject->Country = $country;
            $countries[] = $localObject;
        }
        return json_encode($countries);
    }
}
