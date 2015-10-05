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
}
