@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1><img class="img img-fluid img-rounded mx-auto" src="{{url('/images/lion.jpg')}}" alt="Image"/>Sign up for event</h1>
            <hr>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel-title">
                                    <h4>{{ $event->name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead">{{ $event->type }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Event start date: {{ date('M j, Y', strtotime($event->start_date)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Event start time:  {{ date('h:ia', strtotime($event->start_date)) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Event end date: {{ date('M j, Y', strtotime($event->end_date)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Event end time:  {{ date('h:ia', strtotime($event->end_date)) }}</p>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <div class="row">
                                <div class="col-md-6">
                                    {{ Form::open(['method' => 'POST', 'route' => ['events.user_sign_up.store', $event->id]]) }}
                                    {{Form::hidden('user_id', $user, array('class' => 'form-control') )}}
                                    <br>
                                    {{Form::hidden('event_id', $event->id, array('class' => 'form-control') )}}
                                    <br>
                                    {{Form::label('number_attending','Number Attending')}}
                                    {{Form::number('number_attending', null, array('class' => 'form-control') )}}
                                    <br>
                                    {{Form::label('notes','Notes')}}
                                    {{Form::text('notes', null, array('class' => 'form-control') )}}
                                    <br>
                                    {{Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px'))}}
                                    {!! Html::linkRoute('events.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block", 'style' => 'margin-top: 20px')) !!}
                                    {{ Form::close() }}
                                </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection