<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPreference extends Model
{
    public $timestamps = false;
    protected $table = 'Company_Preference';
    protected $primaryKey ='id_Company_Preference';
    protected $fillable = ["Why_This_Firm","Compensation_Notes", "id_Company"];

    private $validatorRules = [
        'id_Company' => 'required|numeric',
        'Why_This_Firm' => 'required|string',
        'Compensation_Notes' => 'required|string'
    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
}
