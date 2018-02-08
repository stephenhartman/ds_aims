@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1><img class="img img-fluid img-rounded mx-auto" src="{{url('/images/lion.jpg')}}" alt="Image"/>Update event</h1>
            {{ Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'PUT']) }}
            {{Form::label('event_title','Event Title')}}
            {{Form::text('event_title', $event->title, array('class' => 'form-control', 'required' => 'required') )}}

            {{Form::label('event_type','Event Type')}} <br>
            {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'], $event->type)}}
            <br>
            {{Form::label ('event_start_date', 'Event Date')}}
            {{Form::date('event_start_date', $sd, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_start_time', 'Event Start Time')}}
            {{Form::time('event_start_time', $st, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_end_time', 'Event End Time')}}
            {{Form::time('event_end_time', $et, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_description', 'Event Description')}}
            {{Form::text('event_description', $event->description, array('class' => 'form-control', 'required' => 'required') )}}
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="well">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::submit('Save Changes', array('class' => 'btn btn-success btn-lg btn-block')) }}
                        {{ Form::close() }}
                    </div>
                    <div class="col-md-6">
                        {{ Html::linkRoute('events.index', 'Cancel', array($event->id), array('class' => "btn btn-danger btn-lg btn-block")) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
