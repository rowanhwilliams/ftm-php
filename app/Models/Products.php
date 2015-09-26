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
    public function focusSubType(){
        return $this->hasOne('App\Models\ProductFocusSubType', 'id_Product_Focus_Sub_Type');
    }
}
