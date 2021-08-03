<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/x-icon" href="https://dashif.org/img/favicon.ico"/>
        <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no">

        <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap-theme.css')}}">
        <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap-glyphicons.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('controlbar/controlbar.css')}}">

        <!--Libs-->
        <script src="{{asset('lib/jquery/jquery-3.1.1.min.js')}}"></script>

        <script src="{{asset('lib/angular/angular.min.js')}}"></script>
        <script src="{{asset('lib/angular/angular-resource.min.js')}}"></script>
        <script src="{{asset('lib/angular/angular-flot.js')}}"></script>

        <script src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>

        <script src="{{asset('lib/flot/jquery.flot.min.js')}}"></script>
        <script src="{{asset('lib/flot/jquery.flot.resize.min.js')}}"></script>
        <script src="{{asset('lib/flot/jquery.flot.axislabels.js')}}"></script>

        <!-- App -->
        <script src="../../dist/dash.all.debug.js"></script>
        <script src="../../dist/dash.mss.debug.js"></script>
        <script src="{{asset('controlbar/ControlBar.js')}}"></script>
        <script src="{{asset('src/cast.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('rules/DownloadRatioRule.js')}}"></script>
        <script src="{{asset('rules/ThroughputRule.js')}}"></script>

        <!-- Google Cast -->
        <script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased" ng-controller="DashController">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
