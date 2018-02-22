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
                        <p>Event start date: {{ date('M j, Y', strtotime($event_child->start_date)) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>Event start time:  {{ date('h:ia', strtotime($event_child->start_date)) }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p>Event end date: {{ date('M j, Y', strtotime($event_child->end_date)) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>Event end time:  {{ date('h:ia', strtotime($event_child->end_date)) }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <p class="lead">{{ $event->description }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <p class="lead">Updates: {{ $event_child->updates }}</p>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    @if (Auth::user()->hasRole('admin'))
                        <div class="col-md-6">
                            {{ Form::open(['method' => 'GET', 'route' => ['events.event_child.edit', $event->id, $event_child->id]]) }}
                            {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array(
                                'type' => 'submit',
                                'class' => 'btn btn-info btn-lg btn-block')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::open(['route' => ['events.event_child.destroy', $event->id, $event_child], 'method' => 'DELETE']) }}
                            {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-lg btn-block',
                                'onclick' => "return confirm('Are you sure?')")) }}
                            {{ Form::close() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
