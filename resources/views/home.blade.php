@extends('layouts.app')

@section('title', 'DePaul Alumni Outreach')

@push('scripts')
    {!! $calendar->script() !!}
    {!! Charts::scripts(['fusioncharts']) !!}
    <script>
        $(function() {
            $('body').on('click', '.chart a', function (e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getChart(url);
                $("html, body").animate({ scrollTop: 63 }, 250);
            });

            function getChart(url) {
                if (url === "#") {
                    $('#div-chart').slideUp();
                }
                else {
                    $('#div-chart').slideDown();
                    $('#div-chart').promise().done(function() {
                        $.ajax({
                            type: "GET",
                            url: url
                        }).done(function (data) {
                            $('#div-chart').html(data);
                        }).fail(function () {
                            alert('Chart could not be loaded.');
                        });
                    });
                }
            }
        });
    </script>
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
        @if (Auth::user()->hasRole('admin'))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Dashboard</h3>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-block btn-primary" href="{{ route('photos.create') }}"><i class="fa fa-plus-square"></i> New Photo</a>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                            Charts <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu chart">
                                            <li><a href="{{ route('charts.education') }}">Education</a></li>
                                            <li><a href="{{ route('charts.occupation') }}">Occupation</a></li>
                                            <li><a href="{{ route('charts.volunteer') }}">Volunteers</a></li>
                                            <li><a href="{{ route('charts.loyal_lion') }}">Loyal Lions</a></li>
                                            <li><a href="{{ route('charts.year_graduated') }}">Graduation Years</a></li>
                                            <li><a href="#"><i class="fa fa-window-close"></i> Close</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="div-chart">
                                <!-- AJAX CHART LOADS HERE -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Latest Posts</h3>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                @if (Auth::user()->hasRole('admin'))
                                    <a class="btn btn-block btn-primary text-right" href="{{ route('posts.create') }}" style="margin-top:10px"><i class="fa fa-plus-square"></i> New Post</a>
                                @endif
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
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Upcoming Events</h3>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                @if (Auth::user()->hasRole('admin'))
                                    <a class="btn btn-block btn-primary text-right" href="{{ route('events.create') }}" style="margin-top:10px"><i class="fa fa-plus-square"></i> New event</a>
                                @endif
                            </div>
                        </div>
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
                    <hr>
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
                        <a class="btn btn-primary" id="location" target="_blank"></a>
                        @if (Auth::user()->hasRole('admin'))
                            <a class="btn btn-info" id="eventUrl"></a>
                            <a class="btn btn-success" id="index"></a>
                        @else
                            <a class="btn btn-success" id="sign_up"></a>
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
