<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitorProduct extends Model
{
    public $timestamps = false;
    protected $table="Product_Competitor_Product";
    protected $primaryKey ="id_Competitor_Product";
    //protected $fillable = ['id_Product','id_Competitor_Product'];
}
