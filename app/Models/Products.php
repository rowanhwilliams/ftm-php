<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps = false;
    protected $table="Product";
    protected $primaryKey ="id_Product";
    protected $guarded = [];
}
