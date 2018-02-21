@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{!! trans('laravel-user-verification::user-verification.verification_error_header') !!}</div>
                <div class="panel-body">
                    <div class="alert alert-danger" role="alert">
                        <strong>{!! trans('laravel-user-verification::user-verification.verification_error_message') !!}</strong>
                        Please check to see you confirmed the latest verification email.
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <a href={{ route('resend-verification', Auth::id()) }} class="btn btn-primary btn-sm btn-block">
                                Resend Verification
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{url('/')}}" class="btn btn-warning btn-sm btn-block">
                                {!! trans('laravel-user-verification::user-verification.verification_error_back_button') !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
