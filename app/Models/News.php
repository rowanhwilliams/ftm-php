<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class NewsCategories
{
    const All = "All";
    const Comany = "Company";
    const People = "People";
    const Vertical = "Vertical";
    const Products = "Products";
    const Events = "Events";
}

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

    public function employee() {
        return $this->belongsToMany('App\Models\Employee','News_Employee', 'id_News', 'id_Employee');
    }

    protected function GetNews(){
        $news = $this
            ->leftJoin('News_Type', 'News.id_News_Type', '=', 'News_Type.id_News_Type')
            ->whereNull("Deleted")
            ->orderBy('Story_Date', 'asc');
        return $news->get();
    }

    protected function GetNewsSearchBy()
    {
        return ['News.Story_Headline', 'News.Story_Description', 'News_Type.News_Type_Name'];
    }

    protected function SearchNews($search)
    {
        $searchFilters = $this->GetNewsSearchBy();
        $news = $this
            ->leftJoin('News_Type', 'News.id_News_Type', '=', 'News_Type.id_News_Type')
            ->whereNull("Deleted");
            if (count($searchFilters)) {
                $news->where(
                    function ($query) use ($searchFilters, $search) {
                        foreach($searchFilters as $searchFilter)
                        {
                            $query->where($searchFilter, 'like', "%$search%", "OR");
                        }
                    }
                );
            }
        $news->orderBy('Story_Date', 'asc');

        return $news->get();

    }

    public $target = ["Companies", "People", "Vertical", "Products", "Events"];
    private $validatorRules = [
        'id_News_Type' => 'required|numeric',
        'Story_Headline' => 'required|string',
        'Story_Date' => 'required|string',
        'id_Object_Group' => 'required|string',
        'Story_Description' => 'required|string',
    ];
    public function Tags($categories = "All")
    {
        $tags = [];
        if ($categories == NewsCategories::All || $categories == NewsCategories::Comany) {
            foreach($this->company()->get() as $item)
            {
                $tags[] = (object)["target" => $this->target[0], "id" => $item->id_Company, "description"=>$item->Company_Full_Name];
            }
        }
        if ($categories == NewsCategories::All || $categories == NewsCategories::Products) {
            foreach($this->product()->get() as $item)
            {
                $tags[] = (object)["target" => $this->target[3], "id" => $item->id_Product, "description"=>$item->Product_Title];
            }
        }
        if ($categories == NewsCategories::All || $categories == NewsCategories::People) {
            foreach ($this->employee()->get() as $item) {
                $people = People::where("id_People", "=", $item->id_People)->first();
                $tags[] = (object)["target" => $this->target[1], "id" => $item->id_People, "description" => $people->First_Name];
            }
        }
        return $tags;
    }
    protected function getValidatorRules()
    {
        return $this->validatorRules;
    }
}
