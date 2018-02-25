<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DePaul Alumni Outreach</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
</head>
<navbar class="navbar navbar-default">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ route('register') }}">Register</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            @else
                <li><a href="{{ url('/home') }}">Home</a></li>
            @endif
        </ul>
    </div>
</navbar>
<body>
<a href="{{ url('/home') }}" style="color:black;font-size:2em!important;text-decoration:none">
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
</body>
</html>
