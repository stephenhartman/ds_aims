@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endpush

@section('title', 'Events')

@section('content')

    <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <div class="bg-volunteer text-white"> Volunteer events are blue</div>
            <div class="bg-reunion text-white"> Reunion events are red</div>
            <div class="bg-community_event text-white"> Community events are green</div>
        </div>
        <div class="col-md-2 col-md-offset-6">
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('events.create') }}" class="btn btn-block btn-primary btn-lg" style="margin-top: 18px">New Event</a>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! $calendar->calendar() !!}

                {!! $calendar->script() !!}
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
                        <a class="btn btn-info" id="eventUrl" target="_blank">Edit this event</a>
                        <a class="btn btn-success" id="index" target="_blank"></a>
                    @endif
                    @if (!Auth::user()->hasRole('admin'))
                    <a class="btn btn-success" id="sign_up" target="_blank"></a>
                    @endif
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
