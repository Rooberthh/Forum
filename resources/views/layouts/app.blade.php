<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    @if(auth()->user())
     <script charset="utf-8">
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'permissions' => Auth::user()->getAllPermissions(),
            'roles' => Auth::user()->roles->pluck('name')
        ]) !!};
    </script>
    @else
    <script charset="utf-8">
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
        ]) !!};
    </script>
    @endif

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.11.4/trix.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        body{ padding-bottom: 100px; }
        .level{ display: flex; align-items: center; }
        .flex{ flex: 1; }
        [v-cloak] { display: none; }
        .ml-a{ margin-left: auto;}
    </style>

    @yield('header')
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <div class="container d-flex mx-auto flex-grow-1">
            <main class="py-4 flex-grow-1 bg-white">
                @yield('content')
            </main>
            @section('sidebar')
                @include('sidebar')
            @show
        </div>

        <flash-message message="{{ session('flash') }}"></flash-message>
        <div v-cloak>
            @include('modals.all')
        </div>
    </div>
</body>
</html>
