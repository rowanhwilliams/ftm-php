<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Addresses;
use App\Models\Phones;

class HeadquartersInformation extends Model
{
    public $timestamps = false;
    protected $table="Headquarters_Information";
    protected $primaryKey ="id_Headquarters_Information";
    protected $fillable = ['PhoneId','AddressId','id_Company'];
    public function addresses(){
        return $this->hasOne('App\Models\Addresses', 'AddressId');
    }
    public function phones(){
        return $this->hasOne('App\Models\Phones', 'PhoneId');
    }
}
