<div class="col-md-6">
    {{ Form::open(['route' => ['events.user_sign_up.destroy', $event->id, $enroll->id], 'method' => 'DELETE']) }}
    {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array(
        'type' => 'submit',
        'data-id' => $enroll->id,
        'class' => 'btn btn-danger btn-lg btn-block',
        'onclick' => "return confirm('Are you sure?')")) }}
    {{ Form::close() }}
</div>
