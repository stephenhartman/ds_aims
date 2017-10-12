@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Update an event</h1>
            <hr>
            {!! Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'PUT']) !!}
            {{Form::label('event_name','Event Name')}}
            {{Form::text('event_name', $event->name, array('class' => 'form-control') )}}

            {{Form::label('event_type','Event Type')}} <br>
            {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'], $event->type)}}
            <br>
            {{Form::label ('event_date', 'Event Date')}}
            {{Form::date('event_date', $event->date, array('class' => 'form-control') )}}
            <br>
            {{Form::label ('event_time', 'Event Time')}}
            {{Form::time('event_time', $event->time, array('class' => 'form-control') )}}

            {{Form::submit('Save Changes', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px'))}}
            {!! Html::linkRoute('events.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block", 'style' => 'margin-top: 20px')) !!}


            {!! Form::close() !!}
        </div>
    </div>
@endsection
