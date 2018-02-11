@extends('layouts.app')

@section('title', 'Edit Manager')

@section('content')
    {{ Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <h1>Event Manager</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="panel-title">
                            @if( $event->repeats == 1 )
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{Form::checkbox('all_events', 1, false, array('id' =>'all_events_id', 'onchange' => ''))}} Make changes to all events of this type  </label>
                                    <script>
                                        $(document).ready(function(){
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
                                    {{Form::text('event_title', $event->title, array('class' => 'form-control', 'id' => 'title_edit','required'))}}
                                </div>
                                <div class="col-md-3 col-md-offset-3">
                                    {{Form::select('event_type', ['Volunteer' => 'Volunteer', 'Reunion' => 'Reunion', 'Community Event' => 'Community Event'], $event->type, ['id' => 'type_edit', 'class' => 'form-control'])}}
                                </div>
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
                            {{Form::label ('event_description', 'Event Description', ['style' => 'display:none', 'id' => 'desc_label'])}}
                            {{Form::textarea('event_description', $event->description, array('class' => 'form-control', 'required', 'id' => 'event_description_edit') )}}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            {{ Form::submit('Save Changes', array('class' => 'btn btn-success btn-lg btn-block')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-3">
                            {{ Html::linkRoute('events.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block")) }}
                        </div>
                        <div class="col-md-3">
                            {{ Form::open(['method' => 'DELETE', 'route' => ['events.destroy', $event->id]]) }}
                            {{Form::checkbox('delete_all', 1, false, ['id' => 'delete_all', 'style' => 'display:none'])}}
                            {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array(
                                'type' => 'submit',
                                'onclick' => "return confirm('Are you sure you want to delete this event? If you are making changes to all events of this type all related events will be deleted.')",
                                'class' => 'btn btn-warning btn-lg btn-block')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
