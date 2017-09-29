<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DePaul School AIMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.header')
        <div class="container-fluid">
            @include('layouts.messages')
            <div id="main">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <!-- App scripts -->
        @stack('scripts')
    </div>
</body>
</html>
