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
        return $this->hasOne('App\Models\EmployeeType', 'id_Employee_Type', 'id_Employee_Type');
    }

}
