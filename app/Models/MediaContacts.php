<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaContacts extends Model
{
    public $timestamps = false;
    protected $table="Media_Contact";
    protected $primaryKey ="id_Media_Contact";
    protected $fillable = ['Media_contact_Email','Full_Name_Media_Contact','Media_Contact_Phone'];
}
