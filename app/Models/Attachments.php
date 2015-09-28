<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    public $timestamps = false;
    protected $table = 'Attachments';
    protected $primaryKey ="id_Attachments";
    protected $fillable = ['Attachment_File_Name','Attachment_Storage_File_Name'];
}
