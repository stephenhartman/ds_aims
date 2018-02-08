@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    {{ Form::model($event_child, ['route' => ['events.event_child.update', $event->id, $event_child], 'method' => 'PUT']) }}
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            {{Form::label('event_title','Event Name')}}
            {{Form::text('event_title', $event->title, array('class' => 'form-control', 'disabled') )}}

            {{Form::label('event_type','Event Type')}} <br>
            {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'], $event->type, array('disabled'))}}
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
            {{Form::text('event_description', $event->description, array('class' => 'form-control', 'disabled') )}}
            <br>
            {{Form::label ('event_updates', 'Event Updates')}}
            {{Form::text('event_updates', null, array('class' => 'form-control') )}}
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="well">
                <div class="row">
                    <div class="col-md-6">
                        {{ Html::linkRoute('events.event_child.show', 'Cancel', array($event->id, $event_child), array('class' => "btn btn-danger btn-lg btn-block")) }}
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
