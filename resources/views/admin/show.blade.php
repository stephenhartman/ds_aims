@extends('layouts.app')

@section('title', 'Admin Profile')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-change').submit(function (event) {
                event.preventDefault();
                swal({
                    title: "Change your email?",
                    text: 'If you change your email address you will no longer be able to log in with social media.  You will also be prompted to change your password after email verification.',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete) {
                        $("#form-change").off("submit").submit();
                    }
                });
            });
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
                        'method' => 'PATCH', 'id' => 'form-change']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', 'Name', ['class' => 'required']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('email', 'Email Address', ['class' => 'required']) }}
                                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                {{ Form::button('<i class="fa fa-save"></i> Save ', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-3">
                                <a href="{{ action('HomeController@index') }}" class="btn btn-warning btn-lg btn-block">
                                    <span class="fa fa-ban"></span> Cancel
                                </a>
                            </div>
                            <div class="text-center col-md-6">
                                <h5>
                                    A <span class="required"></span>
                                    indicates a required field.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
