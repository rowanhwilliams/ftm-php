<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetClass extends Model
{
    public $timestamps = false;
    protected $table="Asset_Class";
    protected $primaryKey ="id_Asset_Class";
}
