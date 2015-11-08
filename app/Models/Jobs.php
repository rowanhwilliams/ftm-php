<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public $timestamps = false;
    protected $table = 'Job';
    protected $primaryKey ='id_Job';
    protected $guarded = [];

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
    public function companyPreference()
    {
        return $this->hasOne('App\Models\CompanyPreference', 'id_Company_Preference');
    }
}
