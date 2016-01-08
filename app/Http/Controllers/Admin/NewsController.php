<?php

namespace App\Http\Controllers\Admin;

use App\Models\Companies;
use App\Models\Employee;
use App\Models\News;
use App\Models\NewsType;
use App\Models\People;
use App\Models\Products;
use App\Models\Vertical;
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
        $news = News::GetNews();
        $activePage = "";
        return view("admin.news.index", compact("news", "activePage"));
    }


    public function search(Request $request)
    {
        $activePage = $request->page ? $request->page : "";
        $search = $request->get("search");
        $news = News::SearchNews($search);
        return view("admin.news.index", compact("news", "search", "activePage"));
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
        DB::table('News_Employee')->where("id_News", "=", $newsModel->id_News)->delete();
        foreach($newsModel->target as $relationTarget)
        {
            $matches =  preg_grep('/^'.$relationTarget."_*/i",array_keys($request->all()));
            foreach ($matches as $targetItem)
            {
                if ($request->get($targetItem) == "on") {
                    $ObjectTrgetId = str_replace($relationTarget."_", "", $targetItem);
                    switch ($relationTarget){
                        case 'Companies':
                            $newsModel->company()->save(Companies::findOrNew($ObjectTrgetId));
                            break;
                        case 'People':
                            $employeeModel = Employee::where("id_People", "=", $ObjectTrgetId)->first();
                            //dd($employeeModel);
                            $newsModel->employee()->save(Employee::findOrNew($employeeModel->id_Employee));
                            break;
                        case 'Vertical':
                            break;
                        case 'Products':
                            $newsModel->product()->save(Products::findOrNew($ObjectTrgetId));
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

    public function getTags($id) {
        $news = News::findOrFail($id);
        return json_encode($news->Tags());
    }

    public function getTagsList($category)
    {
        switch ($category)
        {
            case 'Companies':
                return Companies::whereNull("Deleted")->orderBy('Company_Full_Name','asc')
                        ->get(['id_Company as id','Company_Full_Name as description'])->toJson();
            case 'People':
                return People::whereNull("Deleted")->orderBy('First_Name','asc')
                        ->get(['id_People as id','First_Name as description'])->toJson();
            case 'Vertical':
                return Vertical::all(['id_Vertical as id','Main_Description as description'])->toJson();
            case 'Products':
                return Products::whereNull("Deleted")->orderBy('Product_Title','asc')
                        ->get(['id_Product as id','Product_Title as description'])->toArray();
            case 'Events':
                return Event::all(['id_Event as id','Event_Title as description'])->toJson();
        }
    }
}
