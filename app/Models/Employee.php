<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $table = 'Employee';
    protected $primaryKey = "id_Employee";
    protected $guarded = [];
}
