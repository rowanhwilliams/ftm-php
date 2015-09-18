<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    public $timestamps = false;
    protected $table = 'Addresses';
    protected $primaryKey ="AddressId";
    protected $fillable = ['AddressLine1','AddressLine2','City','State','PostalCode','id_Country'];
}
