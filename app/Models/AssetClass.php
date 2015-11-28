<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetClass extends Model
{
    public $timestamps = false;
    protected $table="Asset_Class";
    protected $primaryKey ="id_Asset_Class";

    private $validatorRules = [

    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
    protected function CheckboxesModel()
    {
        $AssetClassList = [];
        $AssetClasses = $this->all()->sortBy("Asset_Class");
        foreach($AssetClasses as $AssetClass){
            $AssetClassList[] = (object) array(
                'name' => "Asset_Class_" . $AssetClass->id_Asset_Class,
                'description' => $AssetClass->Asset_Class
            );
        }
        return $AssetClassList;
    }
    protected function getSelected($request)
    {
        $AssetClassList = [];
        $AssetClassListModel = $this->CheckboxesModel();
        foreach($AssetClassListModel as $AssetClass)
        {
            if ($request->{$AssetClass->name} == "on")
            {
                $AssetClassList[] = (integer) str_replace("Asset_Class_", "", $AssetClass->name);
            }
        }
        return $AssetClassList;
    }
}
