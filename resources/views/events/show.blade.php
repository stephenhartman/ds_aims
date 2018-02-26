@extends('layouts.app')

@section('title', $event->title )

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel-title">
                            <h4>{{ $event->title }}</h4>
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
                <div class="row">
                    <div class="col-md-8">
                        <br>
                        <p> {{ $event->description }}</p>
                    </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    @if (Auth::user()->hasRole('admin'))
                        <div class="col-md-6">
                            {{ Form::open(['method' => 'GET', 'route' => ['events.edit', $event->id]]) }}
                            {{ Form::button('<i class="fa fa-edit"></i> Edit', array(
                                'type' => 'submit',
                                'class' => 'btn btn-info btn-lg btn-block',
                                'style' => 'margin-top:20px')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::open(['route' => ['events.destroy', $event->id], 'method' => 'DELETE']) }}
                            {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
                                'type' => 'submit',
                                'data-id' => $event->id,
                                'class' => 'btn btn-danger btn-lg btn-block',
                                'onclick' => "return confirm('Are you sure?')",
                                'style' => 'margin-top:20px')) }}
                            {{ Form::close() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
