@extends('layouts.app')

@section('title', 'Edit Event')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-delete').submit(function (event) {
                event.preventDefault();
                swal({
                    title: "Delete this event?",
                    text: 'If you are making changes to all events of this type all related events will be deleted.',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete) {
                        swal("The event has been deleted.", {
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
    {{ Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Event Manager</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        @if( $event->repeats == 1 )
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{Form::checkbox('all_events', 1, false, array('id' =>'all_events_id', 'onchange' => ''))}} Make changes to all events of this type  </label>
                                    <script>
                                        $(document).ready(function(){
                                            if($('#all_events_id').is(':checked'))
                                            {
                                                $('#delete_all').prop('checked', true);
                                            }
                                            $('#all_events_id').on('change', function(){
                                                $('#delete_all').prop('checked', this.checked);
                                            })
                                        })
                                    </script>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                {{Form::label('event_title','Event Title')}}
                                {{Form::text('event_title', $event->title, array('class' => 'form-control', 'id' => 'title_edit','required'))}}
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                {{Form::label('event_type','Event Type')}}<br>
                                {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community' => 'Community'], $event->type, ['id' => 'type_edit', 'class' => 'form-control'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            {{Form::label ('event_start_date', 'Event Date')}}
                            {{Form::date('event_start_date', $sd, array('class' => 'form-control') )}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label ('event_start_time', 'Event Start Time')}}
                            {{Form::time('event_start_time', $st, array('class' => 'form-control') )}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label ('event_end_time', 'Event End Time')}}
                            {{Form::time('event_end_time', $et, array('class' => 'form-control') )}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    {{Form::label ('event_location', 'Event Address'), ['id' => 'event_location_edit']}}
                                    {{Form::text('event_location', $event->location, array('class' => 'form-control', 'required' => 'required', 'id' => 'event_description_edit') )}}
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{Form::label ('event_description', 'Event Description', ['id' => 'desc_label'])}}
                                    {{Form::textarea('event_description', $event->description, array('class' => 'form-control', 'required', 'id' => 'event_description_edit') )}}
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-4">
                            {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-4">
                            <a href="{{ action('EventController@index') }}" class="btn btn-warning btn-lg btn-block">
                                <span class="fa fa-ban"></span> Cancel
                            </a>
                        </div>
                        <div class="col-md-4">
                            {{ Form::open(['method' => 'DELETE', 'route' => ['events.destroy', $event->id], 'id' => 'form-delete']) }}
                            {{Form::checkbox('delete_all', 1, false, ['id' => 'delete_all', 'style' => 'display:none'])}}
                            {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-lg btn-block'))}}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
