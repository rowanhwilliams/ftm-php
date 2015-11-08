<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table="Country";
    protected $primaryKey ="id_Country";
    protected function getCountriesOptionsByRegion($regionId = 1)
    {
        $countriesList = $this->all()->sortBy("Country");

        $specificSort = [["id" => 111, "name" => "United States of America"], ["id" => 110, "name" => "United Kingdom"],
                        ["id" => 24, "name" => "Canada"]];
        $countries = [];
        foreach ($specificSort as $country) {
            foreach ($countriesList as $countryItem) {
                if(in_array($countryItem->id_Country, [$country["id"]]) && $regionId == $countryItem->id_Region) {
                    $countries[$country["id"]] = $country["name"];
                }
            }
        }
        foreach ($countriesList as $countryItem)
        {
            if(!in_array($countryItem->id_Country, [110, 111, 24]) && $regionId == $countryItem->id_Region)
            {
                $countries[$countryItem->id_Country] = $countryItem->Country;
            }
        }
        return $countries;
    }

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
