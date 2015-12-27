<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addresses;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use App\Models\People;
use App\Models\Products;
use Illuminate\Routing\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Companies;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index(Request $request)
    {
        return view("admin.dashboard.index");
    }
    /**
     * Get statistic data.
     *
     * @return Response
     */

    public function monthStatistic($month, $year, Request $request)
    {
        $statistics = new \stdClass();
        $StatisticEndDate = Carbon::create($year, $month, 1, 0, 0, 0)->addMonth(1);
        $StatisticStartDate = Carbon::create($year, $month, 1, 0, 0, 0);
        $statistics->companies = [Companies::whereNull("Deleted")->where("Date_Created", "<", $StatisticEndDate)->where("Date_Created", ">", $StatisticStartDate)->get()->count(),
                                    Companies::whereNull("Deleted")->get()->count()];
        $statistics->products = [Products::whereNull("Deleted")->where("Date_Created", "<", $StatisticEndDate)->where("Date_Created", ">", $StatisticStartDate)->get()->count(),
                                 Products::whereNull("Deleted")->get()->count()];
        $statistics->news = [News::whereNull("Deleted")->where("Date_Created", "<", $StatisticEndDate)->where("Date_Created", ">", $StatisticStartDate)->get()->count(),
                             News::whereNull("Deleted")->get()->count()];
        $statistics->people = [People::whereNull("Deleted")->where("Date_Created", "<", $StatisticEndDate)->where("Date_Created", ">", $StatisticStartDate)->get()->count(),
            People::whereNull("Deleted")->get()->count()];

        return json_encode($statistics);
    }
    public function employeeStatistic(Request $request){
        return json_encode(DB::table('Employee_Size')
            ->select(DB::raw('Employee_Size.Employee_Size as label, count(Company.id_Company) as data'))
            ->leftJoin('Company', 'Employee_Size.id_Employee_Size', '=', 'Company.id_Employee_Size')
            ->whereNull("Company.Deleted")
            ->groupBy("Employee_Size.id_Employee_Size")
            ->get());
    }
    public function hqStatistic(Request $request){
        $HQStatistics = DB::table('Addresses')
            ->select(DB::raw('Addresses.City as label, count(Addresses.AddressId) as data'))
            ->groupBy("Addresses.City")
            ->orderBy('data', 'desc')
            ->get();
        $Result = [];
        foreach ($HQStatistics as $Statistic)
        {
            $Result[] = [$Statistic->label, intval($Statistic->data)];
            if (count($Result) > 30 )
            {
                return json_encode($Result);
            }
        }
        return json_encode($Result);
    }
}