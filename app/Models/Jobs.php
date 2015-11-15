<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public $timestamps = false;
    protected $table = 'Job';
    protected $primaryKey ='id_Job';
    protected $guarded = [];

    /**
     * Overload Addresses model constructor.
     *
     * $name string Sets the User's name (Optional)
     */
    public function __construct ($attributes = array())
    {
        parent::__construct($attributes); // Calls Default Constructor
        // By default will use USA country
        if(!$this->id_Job_Type) {
            $this->id_Job_Type = 1;
        }
    }

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
    public function getCompanyPreference()
    {
        return CompanyPreference::whereNotNull('id_Company_Preference')->where("id_Company_Preference", "=", $this->id_Company_Preference)->first();
    }

    public function companyPreference()
    {
        return $this->hasOne('App\Models\CompanyPreference', 'id_Company_Preference', 'id_Company_Preference');
    }

    public function address()
    {
        return $this->hasOne('App\Models\Addresses', 'AddressId', 'AddressId');
    }

    public function getJobType()
    {
        return JobType::where("id_Job_Type", '=', $this->id_Job_Type)->first();
    }
}
