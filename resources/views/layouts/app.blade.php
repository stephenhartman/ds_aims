<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
        <!-- JQuery -->
        <script src="//code.jquery.com/jquery.js"></script>

        <!-- Datatables -->
        <script src="//cdn.datatables.new/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Compiled js -->
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- App scripts -->
        @stack('scripts')
    </div>
</body>
</html>
