@extends('layouts.app')

@section('title', 'Alumni Milestones')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.milestones')
            </div>
        </div>
    </div>
@endsection
