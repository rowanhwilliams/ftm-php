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
        $AvailabilityTerritory = $this->all()->sortBy("Territory_Name");
        $AvailabilityTerritoryList[] = (object) array(
            'name' => "Availability_Territory_8",
            'description' => "Global"
        );
        foreach($AvailabilityTerritory as $AvailabilityTerritoryItem) {
            if ($AvailabilityTerritoryItem->Territory_Name != $AvailabilityTerritoryList[0]->description)
            $AvailabilityTerritoryList[] = (object) array(
                'name' => "Availability_Territory_" . $AvailabilityTerritoryItem->id_Availability_Territory,
                'description' => $AvailabilityTerritoryItem->Territory_Name
            );
        }
        return $AvailabilityTerritoryList;
    }
    protected function getSelected($request)
    {
        $AvailabilityTerritoryList = [];
        $AvailabilityTerritoryListtModel = $this->CheckboxesModel();
        foreach($AvailabilityTerritoryListtModel as $AvailabilityTerritory)
        {
            if ($request->{$AvailabilityTerritory->name} == "on")
            {
                $AvailabilityTerritoryList[] = (integer) str_replace("Availability_Territory_", "", $AvailabilityTerritory->name);
            }
        }
        return $AvailabilityTerritoryList;
    }
}
