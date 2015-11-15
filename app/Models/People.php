<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    public $timestamps = false;
    protected $table = 'People';
    protected $primaryKey = "id_People";
    protected $guarded = [];
    public function universityHistory()
    {
        return $this->hasMany('App\Models\DegreeHistory', 'id_People');
    }
    public function careerHistory()
    {
        return $this->hasMany('App\Models\CareerHistory', 'id_People');
    }
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id_People', 'id_People');
    }
    public function address()
    {
        return $this->hasOne('App\Models\Addresses', 'AddressId', 'AddressId');
    }
}
