@extends('layouts.app')

@section('title', 'Create Event')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1><img class="img img-fluid img-rounded mx-auto" src="{{url('/images/lion.jpg')}}" alt="Image"/>Create new event</h1>
            <hr>
            {!! Form::open(['route' => 'events.store']) !!}
                {{Form::label('event_name','Event Name')}}
                {{Form::text('event_name', null, array('class' => 'form-control') )}}
                <br>
                {{Form::label('event_type','Event Type')}}
                {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'], null, ['placeholder' => 'Pick an event category...', 'class' => 'form-control']) }}
                <br>
                {{Form::label ('event_start_date', 'Event Start  Date')}}
                {{Form::date('event_start_date', \Carbon\Carbon::now(), array('class' => 'form-control') )}}
                <br>
                {{Form::label ('event_start_time', 'Event Start Time')}}
                {{Form::time('event_start_time', null, array('class' => 'form-control') )}}
                <br>
                {{Form::label ('event_end_date', 'Event End Date')}}
                {{Form::date('event_end_date', \Carbon\Carbon::now(), array('class' => 'form-control') )}}
                <br>
                {{Form::label ('event_end_time', 'Event End Time')}}
                {{Form::time('event_end_time', null, array('class' => 'form-control') )}}
                <br>
                {{Form::label ('event_description', 'Event Description')}}
                {{Form::text('event_description', null, array('class' => 'form-control') )}}
                <br>
                {{Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px'))}}
                {!! Html::linkRoute('events.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block", 'style' => 'margin-top: 20px')) !!}


            {!! Form::close() !!}
        </div>
    </div>
@endsection
