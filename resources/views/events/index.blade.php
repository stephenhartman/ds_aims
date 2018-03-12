@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css"/>
    <style>
        .fc-event {
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    {!! $calendar->script() !!}
@endpush

@section('title', 'Event Calendar')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Event Calendar</h2>
                    </div>
                    <div class="col-md-6">
                        <h4>Event Type</h4>
                        <ul class="legend">
                            <li><span class="volunteer"></span> Volunteer</li>
                            <li><span class="reunion"></span> Reunion</li>
                            <li><span class="community"></span> Community</li>
                            <li><span class="signed-up"></span> Signed Up</li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        @if (Auth::user()->hasRole('admin'))
                            <div class="pull-right">
                                <a href="{{ route('events.create') }}" class="btn btn-block btn-primary btn-lg"><i class="fa fa-plus-square"></i> New Event</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {!! $calendar->calendar() !!}
            </div>
        </div>
    </div>
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-window-close"></i></span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body"> </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="location" target="_blank"></a>
                    @if (Auth::user()->hasRole('admin'))
                        <a class="btn btn-info" id="eventUrl"></a>
                        <a class="btn btn-success" id="index"></a>
                    @endif
                    @if (!Auth::user()->hasRole('admin'))
                        <a class="btn btn-success" id="sign_up"></a>
                    @endif
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->hasRole('admin'))
    <div id="newEventModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-window-close"></i></span> <span class="sr-only">close</span></button>
                    <h4 id="newEventTitle" class="modal-title"></h4>
                </div>
                <div class="modal-footer">
                    @if (Auth::user()->hasRole('admin'))
                        {{ Form::open(['method' => 'GET', 'route' => ['events.create']]) }}
                        {{  Form::hidden('date', null, array('class' => 'form-control', 'id' => 'newModalDate') )}}
                        {{ Form::button('<i class="fa fa-plus-square"></i> New Event', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                        {{ Form::close() }}
                    @endif
                    @if (!Auth::user()->hasRole('admin'))
                        <a class="btn btn-success" id="sign_up"></a>
                    @endif
                    <br>
                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
