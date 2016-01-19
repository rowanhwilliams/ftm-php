<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    public $timestamps = false;
    protected $table = 'Employee_Type';
    protected $primaryKey = "id_Employee_Type";
    protected $guarded = [];
    public function getEmployeeTypeById($id = 1)
    {
        return $this->where("id_Employee_Type", "=", $id)->Type_Name;
    }
    protected function getEmployeeTypeOptions()
    {
        $EmployeeTypeOptions = [];
        $EmployeeTypesList = $this->all()->sortBy("Type_Name");
        foreach ($EmployeeTypesList as $EmployeeTypesItem) {
            $EmployeeTypeOptions[$EmployeeTypesItem->id_Employee_Type] = $EmployeeTypesItem->Type_Name;
        }
        return $EmployeeTypeOptions;
    }
}
