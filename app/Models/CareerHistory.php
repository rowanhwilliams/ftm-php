<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHistory extends Model
{
    public $timestamps = false;
    protected $table = 'Career_History';
    protected $primaryKey = "id_Career_History";
    protected $fillable = ['Start_Date_At_Position', 'Finish_Date_At_Position', 'Current_Position_Status', 'id_People' ,'Position_Name','Company_Name'];
}
