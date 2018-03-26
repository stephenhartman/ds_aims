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
        $chart = Charts::database(Occupation::all('type'), 'pie', 'fusioncharts')
            ->elementLabel("Total")
            ->height(500)
            ->responsive(false)
            ->groupBy('type')
            ->title('Occupation Type Data');

        return view('charts.load', ['chart' => $chart]);
    }

    public function education()
    {
        $chart = Charts::database(Education::all('type'), 'pie', 'fusioncharts')
            ->elementLabel("Total")
            ->height(500)
            ->responsive(false)
            ->groupBy('type')
            ->title('Education Type Data');

        return view('charts.load', ['chart' => $chart]);
    }

    public function volunteer()
    {
        $chart = Charts::database(Alumnus::all('volunteer'), 'pie', 'fusioncharts')
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
        $chart = Charts::database(Alumnus::all('loyal_lion'), 'pie', 'fusioncharts')
            ->elementLabel("Total")
            ->height(500)
            ->responsive(false)
            ->groupBy('loyal_lion')
            ->title('Loyal Lion Data')
            ->labels(['No', 'Yes']);

        return view('charts.load', ['chart' => $chart]);
    }

    public function year_graduated()
    {
        $chart = Charts::database(Alumnus::all()->sortBy('year_graduated'), 'bar', 'fusioncharts')
            ->elementLabel("Total")
            ->height(500)
            ->responsive(false)
            ->groupBy('year_graduated')
            ->title('Alumni Graduation Years');

        return view('charts.load', ['chart' => $chart]);
    }
}



 