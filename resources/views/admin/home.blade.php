@extends('layouts.app')

@section('title', 'DePaul Alumni Outreach')

@push('scripts')
    {!! $calendar->script() !!}
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css"/>
    <style>
        .fc-list-item {
            cursor: pointer;
        }
    </style>
@endpush


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel-title">Dashboard</div>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-sm btn-block btn-primary" href="{{ route('posts.create') }}"><i class="fa fa-plus-square"></i> Create new post</a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-sm btn-block btn-primary" href="{{ route('events.create') }}"><i class="fa fa-plus-square"></i> Create new event</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Latest Posts</h3>
                            </div>
                        </div>
                    </div>
                    <div>
                        <br>
                        @include('layouts.posts', ['posts' => $posts])
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <a class="btn btn-primary btn-block" href="{{ URL::to('posts') }}">More Posts</a>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Upcoming Events</h3>
                    </div>
                    <div class="panel-body">
                        <h4>Event Type</h4>
                        <ul class="legend">
                            <li><span class="volunteer"></span> Volunteer</li>
                            <li><span class="reunion"></span> Reunion</li>
                            <li><span class="community"></span> Community</li>
                            <li><span class="signed-up"></span> Signed Up</li>
                        </ul>
                    </div>
                    <hr class="posts">
                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
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
    </div>
@endsection
