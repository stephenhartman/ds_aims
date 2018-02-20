<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>
        {{ Html::favicon('favicon.ico') }}
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @stack('styles')
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')
    </head>
    <body>
        <div id="app">
            @include('layouts.header')
            <div class="container-fluid">
                @include('layouts.messages')
                <div id="main">
                    @yield('content')
                </div>
            </div>
        </div>
        <br><br>
        @include('layouts.footer')
    </body>
</html>
