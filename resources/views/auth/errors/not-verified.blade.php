@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">Please Verify</div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>
                                    Please check your email for the verification message.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <a href="{{ route('resend-verification', array(Auth::id())) }}" class="btn btn-primary">
                                        Resend verification Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
