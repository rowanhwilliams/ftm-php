<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetMarket extends Model
{
    public $timestamps = false;
    protected $table="Target_Market";
    protected $primaryKey ="id_Target_Market";
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
    protected function getTargetMarketCheckboxesModel()
    {
        $TargetsMarketList = [];
        $ProductTargetsMarket = $this->all()->sortBy("Target_End_User");
        foreach($ProductTargetsMarket as $TargetsMarket){
            $TargetsMarketList[] = (object) array(
                'name' => "Target_Market_" . $TargetsMarket->id_Target_Market,
                'description' => $TargetsMarket->Target_Market
            );
        }
        return $TargetsMarketList;
    }
}
