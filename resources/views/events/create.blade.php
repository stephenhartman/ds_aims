@extends('layouts.app')

@section('title', 'Event Manager')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> New Event </h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="panel-title">
                            {!! Form::open(['route' => 'events.store']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    {{Form::label('event_title','Event Title')}}
                                    {{Form::text('event_title', null, array('class' => 'form-control', 'required' => 'required') )}}
                                </div>
                                <div class="col-md-3 col-md-offset-3" >
                                    {{Form::label('event_type','Event Type')}}<br>
                                    {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'], null, ['class' => 'form-control', 'placeholder' => 'Please Select an Option']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            {{Form::label ('event_start_date', 'Event Date')}}
                            {{Form::date('event_start_date', \Carbon\Carbon::now(), array('class' => 'form-control') )}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label ('event_start_time', 'Event Start Time')}}
                            {{Form::time('event_start_time', \Carbon\Carbon::now()->toTimeString(), array('class' => 'form-control') )}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label ('event_end_time', 'Event End Time')}}
                            {{Form::time('event_end_time', \Carbon\Carbon::now()->toTimeString(), array('class' => 'form-control') )}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            {{Form::label ('event_description', 'Event Description')}}
                            {{Form::textarea('event_description', null, array('class' => 'form-control', 'required' => 'required') )}}
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>{{Form::checkbox('repeats', 1, false, array('id' =>'repeats', 'onchange' => ''))}} This is a repeating event</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $('#repeats').on('change', function(){
                                    $('#repeat_freq_label').toggle(this.checked);
                                    $('#repeat_freq_id').toggle(this.checked);
                                    $('#repeat_until_label').toggle(this.checked);
                                    $('#repeat_until_id').toggle(this.checked);
                                })
                            })
                        </script>
                        <div class="col-md-3 col-md-offset-1">
                            {{Form::label ('repeat_freq', 'Repeats how often', ['id' => 'repeat_freq_label', 'style' => 'display:none'])}}
                            {{Form::select('repeat_freq', ['Daily', 'Weekly','Biweekly','Monthly'], 'Daily', ['id' => 'repeat_freq_id', 'class' => 'form-control', 'style' => 'display:none'])}}
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            {{Form::label ('repeat_until', 'Repeats until', ['id' => 'repeat_until_label','style' => 'display:none'])}}
                            {{Form::date ('repeat_until',\Carbon\Carbon::now(),['class' => 'form-control', 'id' => 'repeat_until_id', 'style' => 'display:none'] )}}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                            {{Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block'))}}
                        </div>
                        <div class="col-md-4">
                            {!! Html::linkRoute('events.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block")) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
