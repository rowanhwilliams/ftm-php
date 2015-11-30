<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsEmployee extends Model
{
    public $timestamps = false;
    protected $table = 'News_Employee';
    protected $primaryKey = "id_News";
}
