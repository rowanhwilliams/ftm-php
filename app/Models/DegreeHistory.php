<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DegreeHistory extends Model
{
    public $timestamps = false;
    protected $table = 'Degree_History';
    protected $primaryKey = "id_Degree";
    protected $fillable = ['Start_year', 'Finish_year', 'id_Degree', 'id_People' ,'id_University','University_Name','Degree_title'];
}
