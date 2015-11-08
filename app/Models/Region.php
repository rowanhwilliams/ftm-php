<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table="Region";
    protected $primaryKey ="id_Region";
    protected function getRegionsOptions()
    {
        $regions = [];
        $regionsList = $this->all()->sortBy('Region');
        foreach ($regionsList as $region) {
            $regions[$region->id_Region] = $region->Region;
        }
        return $regions;
    }
}
