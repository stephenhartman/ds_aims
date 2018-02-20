@extends('layouts.app')

@section('title', 'Alumni Demographic Form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Edit Alumni Account</h4>
                    </div>
                    <div class="panel-body">
                        @include('layouts.alumnus')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
