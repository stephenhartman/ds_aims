@extends('layouts.charts') 

@section('title', 'Charts') 

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                {!! Charts::styles() !!}
                <div class="app">
                    <center>
                        {!! $chart->html() !!}
                    </center>
                </div>
                {!! Charts::scripts() !!} 
				{!! $chart->script() !!}
            </div>
        </div>

    </div>
</div>
@stop