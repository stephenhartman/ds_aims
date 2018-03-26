<?php
namespace App\Http\Controllers;
use App\Education;
use App\Occupation;
use App\Alumnus;
use Charts;

class ChartController extends Controller
{
    public function occupation()
    {
		$chart = Charts::database(Occupation::all(), 'pie', 'fusioncharts')
		->elementLabel("Total")
        ->height(500)
		->responsive(false)
		->groupBy('type')
        ->title('Occupation Type Data');

        return view('charts.load', ['chart' => $chart]);
    }

    public function education()
    {
        $chart = Charts::database(Education::all(), 'pie', 'fusioncharts')
            ->elementLabel("Total")
            ->height(500)
            ->responsive(false)
            ->groupBy('type')
            ->title('Education Type Data');

        return view('charts.load', ['chart' => $chart]);
    }

    public function volunteer()
    {
        $chart = Charts::database(Alumnus::all(), 'pie', 'fusioncharts')
            ->elementLabel("Total")
            ->height(500)
            ->responsive(false)
            ->groupBy('volunteer')
            ->title('Volunteer Data')
            ->labels(['No', 'Yes']);

        return view('charts.load', ['chart' => $chart]);
    }

    public function loyal_lion()
    {
        $chart = Charts::database(Alumnus::all(), 'pie', 'fusioncharts')
            ->elementLabel("Total")
            ->height(500)
            ->responsive(false)
            ->groupBy('loyal_lion')
            ->title('Loyal Lion Data')
            ->labels(['No', 'Yes']);

        return view('charts.load', ['chart' => $chart]);
    }
}



 