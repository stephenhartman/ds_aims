@extends('layouts.app')
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endpush
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" media="print" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endpush




@section('title', 'Events')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-1 col-sm-6 col-sm-offset-5">
            <h1>Event Calendar</h1>
        </div>
        <div class="col-md-2 col-sm-12">
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
            {!! $calendar->calendar() !!}

            {!! $calendar->script() !!}
        </div>
    </div>
@endsection
