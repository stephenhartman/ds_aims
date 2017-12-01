@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h1>Event Calendar</h1>
        </div>
        <div class="col-md-2">
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('events.create') }}" class="btn btn-block btn-primary btn-lg" style="margin-top: 18px">New Event</a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table">
                <thead>
                <th>Event Name</th>
                <th>Event Type</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th></th>
                </thead>
                <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td> {{ $event->name }}</td>
                        <td> {{ $event->type }}</td>
                        <td> {{ Carbon::parse($event->date)->format('m/d/Y') }}</td>
                        <td> {{ Carbon::parse($event->time)->format('g:i A') }}</td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-default btn-block btn-sm">View</a>
                            @if (Auth::user()->hasRole('admin'))
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-default btn-block btn-sm">Edit</a>
                            @endif
                        </td>
                        @if (Auth::user()->hasRole('alumni'))
                            <td> <a href="http://google.com">Sign up for this event!</a> </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
