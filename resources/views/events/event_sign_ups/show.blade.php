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

<div class="col-md-6">
    {{ Form::open(['route' => ['events.event_sign_ups.show', $event->id, $enroll->id], 'method' => 'DELETE', 'id' => 'form-delete']) }}
    {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
        'type' => 'submit',
        'data-id' => $enroll->id,
        'class' => 'btn btn-danger btn-lg btn-block' )) }}
    {{ Form::close() }}
</div>
