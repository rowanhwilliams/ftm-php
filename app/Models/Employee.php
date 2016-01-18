<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $table = 'Employee';
    protected $primaryKey = "id_Employee";
    protected $guarded = [];

    public function employeeType()
    {
        return $this->belongsToMany('App\Models\EmployeeType','Employee_Employee_Types','id_Employee','id_Employee_Type');
    }

}
