<div class="col-md-6">
    {{ Form::open(['route' => ['events.event_sign_ups.show', $event->id, $enroll->id], 'method' => 'DELETE']) }}
    {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
        'type' => 'submit',
        'data-id' => $enroll->id,
        'class' => 'btn btn-danger btn-lg btn-block',
        'onclick' => "return confirm('Are you sure?')")) }}
    {{ Form::close() }}
</div>
