<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('/favicon.ico') }}">
    @livewireStyles
</head>

<body>

    <div class="container mx-auto my-1 ">


        @livewire('releases')

    </div>
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>

    @yield('jquery')
</body>

</html>
