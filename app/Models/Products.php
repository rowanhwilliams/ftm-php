<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps = false;
    protected $table="Product";
    protected $primaryKey ="id_Product";
    protected $guarded = [];
    public function competitor() {
        return $this->belongsToMany('App\Models\Products','Product_Competitor_Product', 'id_Competitor_Product','id_Product');
    }
    public function focusSubType() {
        return $this->belongsToMany('App\Models\ProductFocusSubType', 'Product_Product_Focus_Sub_Type', 'id_Product', 'id_Product_Focus_Sub_Type');
    }
    public function attachments() {
        return $this->belongsToMany('App\Models\Attachments','Product_Attachments', 'id_Product', 'id_Attachments');
    }
    public function territory() {
        return $this->belongsToMany('App\Models\AvailabilityTerritory','Product_Availability_Territory', 'id_Product', 'id_Availability_Territory');
    }
    public function assetClass() {
        return $this->belongsToMany('App\Models\AssetClass','Product_Asset_Class', 'id_Product', 'id_Asset_Class');
    }
    public function targetEndUser() {
        return $this->belongsToMany('App\Models\TargetEndUser','Product_Target_End_User', 'id_Product', 'id_Target_End_User');
    }
    public function targetMarket() {
        return $this->belongsToMany('App\Models\TargetMarket','Product_Target_Market', 'id_Product', 'id_Target_Market');
    }
    public function owner()
    {
        return $this->hasOne('App\Models\Companies', 'id_Company', 'id_Owner_Company');
    }
    public function TargetEndUserSelection()
    {
        $TargetEndUserSelection = [];
        $ProductTargetEndUser = $this->targetEndUser()->get();
        if ($ProductTargetEndUser->count() > 0)
        {
            foreach($ProductTargetEndUser as $EndUser)
            {
                $TargetEndUserSelection[] = $EndUser->Target_End_User;
            }
        }
        return  $TargetEndUserSelection;
    }
    public function TargetMarketSelection()
    {
        $TargetMarketSelection = [];
        $ProductTargetMarket = $this->targetMarket()->get();
        if ($ProductTargetMarket->count() > 0)
        {
            foreach($ProductTargetMarket as $Market)
            {
                $TargetMarketSelection[] = $Market->Target_Market;
            }
        }
        return $TargetMarketSelection;
    }
    public function ClassAssetsSelection()
    {
        $ClassAssetsSelection = [];
        $ProductAssetClass = $this->assetClass()->get();
        if ($ProductAssetClass->count() > 0)
        {
            foreach ($ProductAssetClass as $AssetClassItem)
            {
                $ClassAssetsSelection[] = $AssetClassItem->Asset_Class;
            }
        }
        return $ClassAssetsSelection;
    }
    public function TerritorySelection()
    {
        $TerritoriesSelection = [];
        $Territories = $this->territory()->get();
        if ($Territories->count() > 0)
        {
            foreach ($Territories as $Territory)
            {
                $TerritoriesSelection[] = $Territory->Territory_Name;
            }
        }
        return $TerritoriesSelection;
    }
    protected function SelectOptionsModel()
    {
        $products = [];
        $productsList = $this->all(["id_Product","Product_Title"])->sortBy('Product_Title');

        foreach ($productsList as $product) {
            $products[$product->id_Product] = $product->Product_Title;
        }
        return $products;
    }
}
