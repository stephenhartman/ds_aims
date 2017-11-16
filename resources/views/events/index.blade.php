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
                </thead>
                <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td> <a href="{{URL::to('events/' . $event->id) }}"> {{ $event->name }}</a></td>
                        <td> {{$event->type}}</td>
                        <td> {{$event->date}}</td>
                        <td> {{$event->time}}</td>
                        <td> <a href="http://google.com">Sign up for this event!</a> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
