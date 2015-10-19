<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    public $timestamps = false;
    protected $table = 'Degree';
    protected $primaryKey = "id_Degree";
    protected $fillable = ['Degree_title'];
}
