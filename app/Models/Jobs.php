<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public $timestamps = false;
    protected $table = 'Job';
    protected $primaryKey ='id_Job';
    protected $guarded = [];
}
