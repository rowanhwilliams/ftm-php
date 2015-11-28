<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetEndUser extends Model
{
    public $timestamps = false;
    protected $table="Target_End_User";
    protected $primaryKey ="id_Target_End_User";
    private $validatorRules = [

    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
    protected function CheckboxesModel()
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
    protected function getSelected($request)
    {
        $targetEndUserList = [];
        $targetEndUserModel = $this->CheckboxesModel();
        foreach($targetEndUserModel as $targetEndUser)
        {
            if ($request->{$targetEndUser->name} == "on")
            {
                $targetEndUserList[] = (integer) str_replace("Target_End_User_", "", $targetEndUser->name);
            }
        }
        return $targetEndUserList;
    }
}
