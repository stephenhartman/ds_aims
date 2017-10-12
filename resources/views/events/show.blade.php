@extends('layouts.app')

@section('title', $event->name )

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <h1>Event Details</h1>
            <table class="table">
                <thead>
                    <th>Event Name</th>
                    <th>Event Type</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                </thead>
                <tbody>
                    <tr>
                        <td> {{$event->name}}</td>
                        <td> {{$event->type}}</td>
                        <td> {{$event->date}}</td>
                        <td> {{$event->time}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::open(['method' => 'GET', 'route' => ['events.edit', $event->id]]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array('type' => 'submit', 'class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['events.destroy', $event->id], ]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'data-id' => $event->id, 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')")) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
