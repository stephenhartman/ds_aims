@extends('layouts.app')

@section('title', 'DePaul Alumni Outreach')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css"/>
@endpush

@section('content')
    <div class="container">
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
                {!! $calendar->calendar() !!}

                {!! $calendar->script() !!}
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
    </div>
@endsection
