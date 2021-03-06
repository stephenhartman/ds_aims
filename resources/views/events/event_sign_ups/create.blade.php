@extends('layouts.app')

@section('title', 'Sign Up!')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h1>Sign up for event</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{$event->title}}</h4>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <h4 style="text-align: right">{{$event->type}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            <h4>Date:<br> {{$sd}}</h4>
                        </div>
                        <div class="col-md-3">
                            <h4>Start Time:<br> {{$st}}</h4>
                        </div>
                        <div class="col-md-3">
                            <h4>End Time:<br> {{ $et }}</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4> Location: {{$event->location}}</h4>
                            <br>
                            <p> {{$event->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-3">
                        {{ Form::open(['method' => 'POST', 'route' => ['events.event_sign_ups.store', $event->id]]) }}
                        {{Form::hidden('user_id', $user, array('class' => 'form-control') )}}
                        {{Form::hidden('event_id', $event->id, array('class' => 'form-control') )}}

                        {{Form::label('number_attending','Number Attending')}}
                        {{Form::number('number_attending', 1, array('min'=> '0', 'class' => 'form-control', 'required'))}}
                        </div>
                        <div class="col-md-6 col-md-offset-2">
                            {{Form::label('notes','Notes')}}
                            {{Form::text('notes', null, array('class' => 'form-control') )}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-1">
                            {{ Form::button('<i class="fa fa-save"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                            <a href="{{ action('EventController@index') }}" class="btn btn-warning btn-lg btn-block">
                                <span class="fa fa-ban"></span> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection