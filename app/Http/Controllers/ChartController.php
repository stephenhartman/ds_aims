<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Education;
use App\Occupation;
use App\Http\Requests;
use Charts;

class ChartController extends Controller
{
    public function index()
    {
		
		$chart = Charts::database(Occupation::all(), 'pie', 'fusioncharts')
		->elementLabel("Total")
		->dimensions(600, 300)
		->responsive(false)
		->groupBy('type');
		
		
        return view('charts.index', ['chart' => $chart]);

    }
	
}



 