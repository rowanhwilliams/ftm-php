<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\NewsType;
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
        $news = News::where("Deleted", "=", NULL)->get()->sortBy("Story_Headline");
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
        if ($id)
        {
            $news = News::findOrNew($id);
        }
        if ($news->Story_Date)
        {
            $Story_Date = Carbon::parse($news->Story_Date);
        }
        else {
            $Story_Date = Carbon::now();
        }

        $newsTypesOptions = NewsType::getNewsTypeOptions();
        //dd($Story_Date->minute);
        return compact("news", "newsTypesOptions","Story_Date");
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
        $newsFields["Story_Date"] = Carbon::create($newsFields["Story_Year"], $newsFields["Story_Month"],$newsFields["Story_Day"],$newsFields["Story_Hour"], $newsFields["Story_Minutes"]);
        $newsModel = News::create($newsFields);
        return redirect(route('admin.news.index'))->with('flash', 'The News was created');
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
        $newsFields["Story_Date"] = Carbon::create($newsFields["Story_Year"], $newsFields["Story_Month"],$newsFields["Story_Day"],$newsFields["Story_Hour"], $newsFields["Story_Minutes"]);
        $newsModel->fill($newsFields)->save();
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
}
