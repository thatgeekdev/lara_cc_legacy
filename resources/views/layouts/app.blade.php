<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tasks</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> ... </nav>
    <main class="py-4">@yield('content')</main>
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
</body>

</html>