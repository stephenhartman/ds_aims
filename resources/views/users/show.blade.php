@extends('layouts.app')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-change').submit(function (event) {
                event.preventDefault();
                swal({
                    title: "Change your email?",
                    text: 'If you change your email address and you previously registered with social media, you will no longer be able to log in with social media and you will be prompted to change your password after email verification.',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((ok) => {
                    if(ok) {
                        $("#form-change").off("submit").submit();
                    }
                });
            });
            if($('#parent').is(':checked'))
            {
                $('#parent_name_label').show();
                $('#parent_name').show();
            }
            $('#parent').on('change', function(){
                $('#parent_name_label').toggle(this.checked);
                $('#parent_name').toggle(this.checked);
            })
            $('#output').on('load', function () {
                setTimeout(function(){
                    $("#photoModal").modal('show');
                }, 250);
            });
        });
    </script>
@endpush

@section('content')
    <div class="container">
       <div class="row">
            <div class="col-md-6">
                {{ Form::model($user, ['route' => array('users.update', $user),
                'method' => 'PATCH', 'id' => 'form-change']) }}
                @include('layouts.email')
                {{ Form::close() }}
                {{ Form::model($alumnus, ['route' => array('users.alumni.update', $user, $alumnus),
                'method' => 'PATCH', 'enctype' => 'multipart/form-data']) }}
                @include('layouts.alumnus')
            </div>
            <div class="row">
               <div class="col-md-6">
                  @include('layouts.photo')
               </div>
                <div class="col-md-6">
                    @include('layouts.milestones')
                </div>
            </div>
        </div>
        <div id="photoModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-window-close"></i></span> <span class="sr-only">close</span></button>
                        <h4 class="modal-title">Photo Preview</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="output" width="320px" height="auto" style="margin:auto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop