<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;
    protected $table="News";
    protected $primaryKey ="id_News";
    protected $fillable = ["Story_Headline","Story_Date","Story_Description","id_News_Type","Date_Created",
                           "Date_Modified","Created_By","Deleted"];

    private $validatorRules = [
        'id_News_Type' => 'required|numeric',
        'Story_Headline' => 'required|string',
        'Story_Hour' => 'required|numeric',
        'Story_Minutes' => 'required|numeric',
        'Story_Day' => 'required|numeric',
        'Story_Month' => 'required|numeric',
        'Story_Year' => 'required|numeric',
        'Story_Description' => 'required|string',
    ];

    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
}
