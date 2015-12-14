<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    public $timestamps = false;
    protected $table="News";
    protected $primaryKey ="id_News";
    protected $fillable = ["Story_Headline","Story_Date","Story_Description","id_News_Type","Date_Created",
                           "Date_Modified","Created_By","Deleted"];

    public function product() {
        return $this->belongsToMany('App\Models\Products','News_Product', 'id_News', 'id_Product');
    }

    public function company() {
        return $this->belongsToMany('App\Models\Companies','News_Company', 'id_News', 'id_Company');
    }
    protected function getNews(){
        $news = $this
            ->leftJoin('News_Type', 'News.id_News_Type', '=', 'News_Type.id_News_Type')
            ->whereNull("Deleted")
            ->orderBy('Story_Date', 'asc');
        return $news->get();
    }

//    public function people() {
//        return $this->belongsToMany('App\Models\People','News_Employee', 'id_News', 'id_People');
//    }
    public $target = ["Companies", "People", "Vertical", "Products", "Events"];
    private $validatorRules = [
        'id_News_Type' => 'required|numeric',
        'Story_Headline' => 'required|string',
        'Story_Date' => 'required|string',
        'id_Object_Group' => 'required|string',
//        'id_Object_Item' => 'required|numeric',
        'Story_Description' => 'required|string',
    ];
    public function Tags()
    {
        $tags = [];
        foreach($this->company()->get() as $item)
        {
            $tags[] = (object)["target" => $this->target[0], "id" => $item->id_Company, "description"=>$item->Company_Full_Name];
        }
        foreach($this->product()->get() as $item)
        {
            $tags[] = (object)["target" => $this->target[3], "id" => $item->id_Product, "description"=>$item->Product_Title];
        }
        return $tags;
    }
    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
}
