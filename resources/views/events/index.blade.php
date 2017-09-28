@extends('layouts.app')

@section('title', '| Events')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <h1>Event calendar</h1>
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
            <div class="col-md-2">
                <a href="{{ route('events.create') }}" class="btn btn-block btn-primary" style="margin-top: 18px">New Event</a>
            </div>
        </div>
    </div>
@endsection