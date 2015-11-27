<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetMarket extends Model
{
    public $timestamps = false;
    protected $table="Target_Market";
    protected $primaryKey ="id_Target_Market";
    private $validatorRules = [

    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
    protected function CheckboxesModel()
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
