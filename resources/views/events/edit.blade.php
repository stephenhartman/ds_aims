@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    {{ Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Update an event</h1>
            <hr>
            {{Form::label('event_name','Event Name')}}
            {{Form::text('event_name', $event->name, array('class' => 'form-control') )}}

            {{Form::label('event_type','Event Type')}} <br>
            {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'], $event->type)}}
            <br>
            {{Form::label ('event_start_date', 'Event Start Date')}}
            {{Form::date('event_start_date', $sd, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_start_time', 'Event Start Time')}}
            {{Form::time('event_start_time', $st, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_end_date', 'Event End Date')}}
            {{Form::date('event_end_date', $ed, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_end_time', 'Event End Time')}}
            {{Form::time('event_end_time', $et, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_description', 'Event Description')}}
            {{Form::text('event_description', $event->description, array('class' => 'form-control') )}}
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="well">
                <div class="row">
                    <div class="col-md-6">
                        {{ Html::linkRoute('events.show', 'Cancel', array($event->id), array('class' => "btn btn-danger btn-lg btn-block")) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::submit('Save Changes', array('class' => 'btn btn-success btn-lg btn-block')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
