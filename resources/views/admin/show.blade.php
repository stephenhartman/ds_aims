@extends('layouts.app')

@section('title', 'Admin Profile')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#email').one("click", function (event) {
                event.preventDefault();
                swal({
                    title: "Change your email?",
                    text: 'If you change your email address and you previously registered with social media, you will no longer be able to log in with social media and you will be prompted to change your password after email verification.',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((ok) => {
                    if(ok) {
                        $("#email").focus();
                    }
                });
            });
        });
        $("#photo_url").change(function(){
            $("#photoModal").show();
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Edit User Profile</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::model($user, ['route' => array('users.update', $user),
                        'method' => 'PATCH', 'id' => 'form-change', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <figure class="figure">
                                    @if ($user->photo_url !== null)
                                        <figcaption class="figure-caption">Current Profile Photo</figcaption>
                                        <img class="img-thumbnail img-responsive" src="{{ url($user->photo_url) }}">
                                    @endif
                                </figure>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('photo_url', 'Upload a profile picture') }}
                                    {{ Form::file('photo_url', ['accept' => 'image/*', 'onchange' => "document.getElementById('output').src = window.URL.createObjectURL(this.files[0])", 'data-toggle' => "modal", 'data-target' => "#photoModal"], array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('name', 'Name', ['class' => 'required']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email', 'Email Address', ['class' => 'required']) }}
                                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'email']) }}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                {{ Form::button('<i class="fa fa-save"></i> Save ', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-3">
                                <a href="{{ action('HomeController@index') }}" class="btn btn-warning btn-lg btn-block">
                                    <span class="fa fa-ban"></span> Cancel
                                </a>
                            </div>
                            <div class="text-center col-md-4">
                                <h5>
                                    A <span class="required"></span>
                                    indicates a required field.</h5>
                            </div>
                        </div>
                    </div>
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
@endsection
