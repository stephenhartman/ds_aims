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
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @endauth
        </div>
    @endif
</navbar>
<body>
<div class="content">
    <a href="{{ url('/home') }}" style="color:black; text-decoration:none">
        <div class="title">
            DePaul School Alumni Outreach System
        </div>
        <br>
        <img class="img img-fluid img-responsive" src="{{url('/images/depaul.jpg')}}" alt="Image">
    </a>
</div>
</body>
</html>
