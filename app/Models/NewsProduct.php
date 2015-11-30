<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsProduct extends Model
{
    public $timestamps = false;
    protected $table = 'News_Product';
    protected $primaryKey = "id_News";
}
