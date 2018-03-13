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
    </div>
@stop