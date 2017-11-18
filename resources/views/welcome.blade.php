<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<navbar class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
            @else
                <li><a href="{{ url('/home') }}">Home</a></li>
            @endif
        </ul>
    </div>
</navbar>
<body>
<div class="content">
    <div class="flex-center">
        <a href="{{ url('/home') }}" style="color:black; text-decoration:none">
            <div class="title">
                DePaul School Alumni Outreach System
            </div>
            <br>
            <img class="img img-fluid img-responsive" src="{{url('/images/depaul.jpg')}}" alt="Image">
        </a>
    </div>
</div>
</body>
</html>
