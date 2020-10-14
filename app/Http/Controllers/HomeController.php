<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pending_orders=Sale::where('status',0)->count();
        $complete_orders=Sale::where('status',1)->count();
        $decline_orders=Sale::where('status',Null)->count();

        $chart_options = [
            'chart_title' => 'Total sale by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Sale',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];

        $chart1 = new LaravelChart($chart_options);
        return view('backend.dashboard', compact('pending_orders', 'complete_orders', 'decline_orders', 'chart1'));
    }


}
