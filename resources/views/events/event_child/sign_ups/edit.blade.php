@extends('layouts.app')

@section('title', 'Sign Up!')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-delete').submit(function (event) {
                event.preventDefault();
                swal({
                    title: "Unenroll from this event?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete) {
                        swal("You have unenrolled from this event.", {
                            icon: "success",
                        });
                        $("#form-delete").off("submit").submit();
                    }
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h1>Sign up for event</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{$event->title}}</h4>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <h4 style="text-align: right">{{$event->type}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            <h4>Date:<br> {{$sd}}</h4>
                        </div>
                        <div class="col-md-3">
                            <h4>Start Time:<br> {{$st}}</h4>
                        </div>
                        <div class="col-md-3">
                            <h4>End Time:<br> {{ $et }}</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p> {{$event->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-3">
                            {{ Form::open(['method' => 'PUT', 'route' => ['events.event_child.sign_ups.update', $event->id, $child->id, $enroll]]) }}
                            {{Form::hidden('user_id', $user, array('class' => 'form-control') )}}
                            {{Form::hidden('event_id', $event->id, array('class' => 'form-control') )}}
                            {{Form::hidden('child_id', $child->id, array('class' => 'form-control'))}}

                            {{Form::label('number_attending','Number Attending')}}
                            {{Form::number('number_attending', $enroll->number_attending, array('min'=> '0', 'class' => 'form-control', 'required'))}}
                        </div>
                        <div class="col-md-6 col-md-offset-2">
                            {{Form::label('notes','Notes')}}
                            {{Form::text('notes', $enroll->notes, array('class' => 'form-control') )}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            {{Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block'))}}
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-3">
                            {{ Form::open(['route' => ['events.event_child.sign_ups.destroy', $event->id, $child->id, $enroll->id], 'method' => 'DELETE', 'id' => 'form-delete']) }}
                            {{ Form::button('Unenroll', array(
                                'type' => 'submit',
                                'data-id' => $enroll->id,
                                'class' => 'btn btn-warning btn-lg btn-block',
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-3">
                            {!! Html::linkRoute('events.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block")) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection