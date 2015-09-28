<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    public $timestamps = false;
    protected $table = 'Company';
    protected $primaryKey ="id_Company";
    protected $guarded = [];
    protected $dates = [];
    public function headquaters(){
        return $this->hasOne('App\Models\HeadquartersInformation', 'id_Company');
    }
    public function mediaContacts(){
        return $this->hasMany('App\Models\MediaContacts', 'id_Company');
    }
    public function attachments(){
        return $this->belongsToMany('App\Models\Attachments','Company_Attachments', 'id_Company', 'id_Attachments');
    }
    public function products() {
        return $this->hasMany('App\Models\Products', 'id_Owner_Company');
    }

}