<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public $timestamps = false;
    protected $table = 'University';
    protected $primaryKey = "id_University";
    protected $fillable = ['University_Name'];
}
