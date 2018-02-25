@extends('layouts.app')

@section('title', 'DePaul Alumni Outreach')

@push('styles')
    <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
@endpush

@section('content')
    <a href="{{ url('/home') }}" style="font-size:2em!important;text-decoration:none">
        <div class="text-center h1" style="">
            DePaul School Alumni Outreach System
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <img src="{{url('/images/logo.png')}}" style="height:auto;width:50%;display:block;margin: 0 auto;" alt="Logo">
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
            <span class="h1" style="color: rgb(5, 61, 99);font-family: 'Cabin Sketch', cursive;">
                DePaul School of Northeast Florida
            </span>
                <br>
                <span class="h2" style="color: rgb(255, 102, 0);font-family: 'Cabin Sketch', cursive;">
                We Teach The Way They Learn©
            </span>
            </div>
        </div>
    </a>
@endsection
