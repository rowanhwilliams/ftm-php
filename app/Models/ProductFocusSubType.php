<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFocusSubType extends Model
{
    public $timestamps = false;
    protected $table="Product_Focus_Sub_Type";
    protected $primaryKey ="id_Product_Focus_Sub_Type";
    public function focusType()
    {
        return $this->hasOne('App\Models\ProductFocusType','id_Product_Focus_Type', 'id_Product_Focus_Type');
    }
}