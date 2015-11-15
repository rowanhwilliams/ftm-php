<?php

namespace App\Models;
use \App\Models\Country;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    /**
     * Overload Addresses model constructor.
     *
     * $name string Sets the User's name (Optional)
     */
    public function __construct ($attributes = array())
    {
        parent::__construct($attributes); // Calls Default Constructor
        // By default will use USA country
        if(!$this->id_Country) {
            $this->id_Country = 111;
        }
    }

    public $timestamps = false;
    protected $table = 'Addresses';
    protected $primaryKey ="AddressId";
    protected $fillable = ['AddressLine1','AddressLine2','City','State','PostalCode','id_Country'];

    private $validatorRules = [
        'City' => 'required|string',
        'id_Country' => 'required|numeric',
        'State' => 'string'
    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }

    public function getCountry()
    {
        //return $this->hasOne('App\Models\Country', 'id_Country', 'id_Country');
        return Country::where("id_Country", "=", $this->id_Country)->first();
    }
}
