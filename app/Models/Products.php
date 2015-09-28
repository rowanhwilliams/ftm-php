<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps = false;
    protected $table="Product";
    protected $primaryKey ="id_Product";
    protected $guarded = [];
    public function focus(){
        return $this->hasOne('App\Models\ProductFocus', 'id_Product_Focus');
    }
    public function focusType(){
        return $this->hasOne('App\Models\ProductFocusType', 'id_Product_Focus_Type');
    }
    public function owner(){
        return $this->hasOne('App\Models\Companies', 'id_Company', 'id_Owner_Company');
    }
//    public function competitor(){
//        return $this->hasMany('App\Models\CompetitorProduct','id_Product');
//    }
    public function focusSubType(){
        return $this->hasOne('App\Models\ProductFocusSubType', 'id_Product_Focus_Sub_Type');
    }
    public function attachments(){
        return $this->belongsToMany('App\Models\Attachments','Product_Attachments', 'id_Product', 'id_Attachments');
    }
    public function territory(){
        return $this->belongsToMany('App\Models\AvailabilityTerritory','Availability_Territory', 'id_Product', 'id_Availability_Territory');
    }
    public function assetClass(){
        return $this->belongsToMany('App\Models\AssetClass','Product_Asset_Class', 'id_Product', 'id_Asset_Class');
    }
    public function targetEndUser(){
        return $this->belongsToMany('App\Models\TargetEndUser','Product_Target_End_User', 'id_Product', 'id_Target_End_User');
    }
    public function targetMarket(){
        return $this->belongsToMany('App\Models\TargetMarket','Product_Target_Market', 'id_Product', 'id_Target_Market');
    }
}
