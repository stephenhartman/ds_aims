@extends('layouts.app')

@section('title', '| Events')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Schedule new event</h1>
            <hr>
            {!! Form::open(['route' => 'events.store']) !!}
                {{Form::label('event_name','Event Name')}}
                {{Form::text('event_name', null, array('class' => 'form-control') )}}

                {{Form::label('event_type','Event Type')}} <br>
                {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'])}}
                <br>
                {{Form::label ('event_date', 'Event Date')}}
                {{Form::date('event_date', \Carbon\Carbon::now(), array('class' => 'form-control') )}}
                <br>
                {{Form::label ('event_time', 'Event Time')}}
                {{Form::time('event_time', null, array('class' => 'form-control') )}}

                {{Form::submit('Create', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px'))}}
                {!! Html::linkRoute('events.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block", 'style' => 'margin-top: 20px')) !!}


            {!! Form::close() !!}
        </div>
    </div>
@endsection