<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table="Country";
    protected $primaryKey ="id_Country";
    protected function getListCountries()
    {
        $countryList = $this->all()->sortBy("Country");
        $country = [];
        $country[111] = 'United States of America';
        $country[110] = 'United Kingdom';
        $country[24] = 'Canada';
        foreach ($countryList as $countryItem)
        {
            if(!in_array($countryItem->id_Country, [110, 111, 24]))
            {
                $country[$countryItem->id_Country] = $countryItem->Country;
            }
        }
        return $country;
    }
}
