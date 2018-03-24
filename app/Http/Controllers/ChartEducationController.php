<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Education;
use App\Occupation;
use App\Http\Requests;
use Charts;

class ChartEducationController extends Controller
{
    public function index()
    {
		
		$chart2 = Charts::database(Education::all(), 'pie', 'fusioncharts')
		->elementLabel("Total")
		->dimensions(600, 300)
		->responsive(false)
		->groupBy('type');
		
		
        return view('charts.education.index', ['chart2' => $chart2]);

    }
}