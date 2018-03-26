{!! Charts::styles(['fusioncharts']) !!}

<div style="height:500px">
    {!! $chart->html() !!}
</div>

{!! Charts::scripts(['fusioncharts']) !!}
{!! $chart->script() !!}
