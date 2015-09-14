<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    //
    protected $table = 'Company';
    protected $primaryKey ="id_Company";
    protected $guarded = [];
    public function headquaters(){
        return $this->hasOne("App\Models\HeadquartersInformation");
    }
}