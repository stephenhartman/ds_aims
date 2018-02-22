@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css"/>
@endpush

@push('scripts')
    {!! $calendar->script() !!}
@endpush

@section('title', 'Event Calendar')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <ul class="legend">
                <li><span class="volunteer"></span> Volunteer Events</li>
                <li><span class="reunion"></span> Reunion Events</li>
                <li><span class="community"></span> Community Events</li>
                <li><span class="signed-up"></span> Signed Up Events</li>
            </ul>
        </div>
        <div class="col-xs-12 col-md-2">
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('events.create') }}" class="btn btn-block btn-primary btn-lg">New Event</a>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! $calendar->calendar() !!}
            </div>
        </div>
    </div>
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body"> </div>
                <div class="modal-footer">
                    @if (Auth::user()->hasRole('admin'))
                        <a class="btn btn-info" id="eventUrl"></a>
                        <a class="btn btn-success" id="index"></a>
                    @endif
                    @if (!Auth::user()->hasRole('admin'))
                    <a class="btn btn-success" id="sign_up"></a>
                    @endif
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
