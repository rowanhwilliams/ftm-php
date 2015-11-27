<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilityTerritory extends Model
{
    public $timestamps = false;
    protected $table="Availability_Territory";
    protected $primaryKey ="id_Availability_Territory";
    protected function SelectOptionsModel()
    {
        $regions = [];
        $regionsList = $this->all()->sortBy('Territory_Name');
        foreach ($regionsList as $region) {
            $regions[$region->id_Availability_Territory] = $region->Territory_Name;
        }
        return $regions;
    }
    protected function CheckboxesModel()
    {
        $AvailabilityTerritoryList = [];
        $AvailabilityTerritory = $this->all()->sortBy("Asset_Class");
        foreach($AvailabilityTerritory as $AvailabilityTerritoryItem){
            $AvailabilityTerritoryList[] = (object) array(
                'name' => "Availability_Territory_" . $AvailabilityTerritoryItem->id_Availability_Territory,
                'description' => $AvailabilityTerritoryItem->Territory_Name
            );
        }
        return $AvailabilityTerritoryList;
    }
}
