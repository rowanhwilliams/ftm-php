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
    public function employeeSize()
    {
        return $this->hasOne('App\Models\EmployeeSize', 'id_Employee_Size');
    }
    protected function SelectOptionsModel()
    {
        $companies = [];
        $companiList = $this->all(["id_Company","Company_Full_Name"])->sortBy('Company_Full_Name');

        foreach ($companiList as $company) {
            $companies[$company->id_Company] = $company->Company_Full_Name;
        }
        return $companies;
    }
    protected function getCompaniesSearchBy(){
        return['Company_Full_Name', 'Company_About_Us'];
//        return [
//            (object) array(
//                'name' => 'Company_Full_Name',
//                'description' => 'Search by Company Name'
//            ),
//            (object) array(
//                'name' => 'Year_Founded',
//                'description' => 'Search by Year Founded'
//            ),
//            (object) array(
//                'name' => 'Company_About_Us',
//                'description' => 'Search by Company Description'
//            )
//        ];
    }

}