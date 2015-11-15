<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{
    protected $table="News_Type";
    protected $primaryKey ="id_News_Type";
    protected function getNewsTypeOptions()
    {
        $NewsTypes = [];
        $NewsTypesList = $this->all()->sortBy("News_Type_Name");
        foreach ($NewsTypesList as $NewsType)
        {
            $NewsTypes[$NewsType->id_News_Type] = $NewsType->News_Type_Name;
        }
        return $NewsTypes;
    }
}
