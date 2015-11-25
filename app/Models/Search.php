<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    private $validatorRules = [
        'Company_Full_Name' => 'sometimes|required|accepted',
        'Year_Founded' => 'sometimes|required|accepted',
        'Company_About_Us' => 'sometimes|required|accepted',
        'search' => 'required|string'
    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
}
