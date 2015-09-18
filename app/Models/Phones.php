<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    public $timestamps = false;
    protected $table = 'Phones';
    protected $primaryKey ="PhoneId";
    protected $fillable = ['PhoneNumber','PhoneType'];
}
