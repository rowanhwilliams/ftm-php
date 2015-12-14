<?php

namespace App\Http\Controllers\Admin;

use App\Models\Companies;
use App\Models\News;
use App\Models\NewsType;
use App\Models\People;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = News::getNews();
        return view("admin.news.index", compact("news"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.news.create", $this->passData());
    }

    private function passData($id = null)
    {
        $news = new \App\Models\News();
        $IdObjectGroup = "Companies";
        if ($id)
        {
            $news = News::findOrNew($id);
        }
        if ($news->Story_Date)
        {
            $Story_Date = Carbon::parse($news->Story_Date)->format("d-M-Y H:i:s");
        }
        else {
            $Story_Date = Carbon::now()->format("d-M-Y H:i:s");
        }

        $newsTypesOptions = NewsType::getNewsTypeOptions();
        $IdObjectItems = $news->Tags();
        return compact("news", "newsTypesOptions","Story_Date", "IdObjectItems");
    }

    public function doValidation(Request $request, $validateRules)
    {
        $requestFields = [];
        $this->validate($request, $validateRules);
        foreach(array_keys($validateRules) as $key){
            $requestFields[$key] = $request[$key];
        }
        return $requestFields;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $newsFields = $this->doValidation($request, News::getValidatorRules());
        $newsFields["Story_Date"] = Carbon::parse($newsFields["Story_Date"]);
        $newsModel = News::create($newsFields);
        $this->saveObjectRelation($request, $newsModel);
        return redirect(route('admin.news.index'))->with('flash', 'The News was created');
    }

    public function saveObjectRelation(Request $request, $newsModel)
    {
        DB::table('News_Company')->where("id_News", "=", $newsModel->id_News)->delete();
        DB::table('News_Product')->where("id_News", "=", $newsModel->id_News)->delete();
        foreach($newsModel->target as $relationTarget)
        {
            $matches =  preg_grep('/^'.$relationTarget."_*/i",array_keys($request->all()));
            foreach ($matches as $targetItem)
            {
                if ($request->get($targetItem) == "on") {
                    switch ($relationTarget){
                        case 'Companies':
                            $newsModel->company()->save(Companies::findOrNew(str_replace($relationTarget."_", "", $targetItem)));
                            break;
                        case 'People':
                            break;
                        case 'Vertical':
                            break;
                        case 'Products':
                            $newsModel->product()->save(Products::findOrNew(str_replace($relationTarget."_", "", $targetItem)));
                            break;
                        case 'Events':
                            break;
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view("admin.news.edit", $this->passData($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $newsModel = News::findOrNew($id);
        $newsFields = $this->doValidation($request, News::getValidatorRules());
        $newsFields["Story_Date"] = Carbon::parse($newsFields["Story_Date"]);
        $newsModel->fill($newsFields)->save();
        $this->saveObjectRelation($request, $newsModel);
        return redirect(route('admin.news.index'))->with('flash', 'The News was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->fill(["Deleted" => Carbon::now()])->save();
        return redirect(route('admin.news.index'));
    }

    public function objectOptions($category)
    {
        switch ($category)
        {
            case 'Companies':
                return Companies::whereNull("Deleted")->orderBy('Company_Full_Name','asc')->get(['id_Company','Company_Full_Name'])->toJson();
            case 'People':
                return People::whereNull("Deleted")->orderBy('First_Name','asc')->get(['id_People','First_Name'])->toJson();
            case 'Vertical':
                return Companies::whereNull("Deleted")->get(['id_Company','Company_Full_Name'])->toJson();
            case 'Products':
                return Products::whereNull("Deleted")->orderBy('Product_Title','asc')->get(['id_Product','Product_Title'])->toJson();
            case 'Events':
                return Companies::whereNull("Deleted")->get(['id_Company','Company_Full_Name'])->toJson();
        }
    }
}
