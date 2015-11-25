<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetEndUser extends Model
{
    public $timestamps = false;
    protected $table="Target_End_User";
    protected $primaryKey ="id_Target_End_User";
    private $validatorRules = [
        'id_Job_Type' => 'required|numeric',
        'Job_Title' => 'required|string',
        'id_Target_End_User' => 'required|numeric',
        'id_Commission_Or_Bonus' => 'required|numeric',
        'Job_Max_Salary' => 'required|numeric',
        'Years_Experience_Required' => 'required|numeric',
        'Percentage_Travel' => 'required|numeric',
        'Variable_Cap' => 'sometimes|accepted',
        'Visa_Sponsorship_Possible' => 'sometimes|accepted',
        'Job_Description' => 'required|string',
        'Job_Requirements' => 'required|string'
    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
    protected function getTargetEndUserCheckboxesModel()
    {
        $TargetsEndUserList = [];
        $ProductTargetsEndUser = $this->all()->sortBy("Target_End_User");
        foreach($ProductTargetsEndUser as $ProductTarget){
            $TargetsEndUserList[] = (object) array(
                'name' => "Target_End_User_" . $ProductTarget->id_Target_End_User,
                'description' => $ProductTarget->Target_End_User
            );
        }
        return $TargetsEndUserList;
    }
    protected function getSelected()
    {

    }
}
