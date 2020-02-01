<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.header')
</head>
<body>
<div id="app">
    @include('partials.navigation')
    @yield('content')
    @include('partials.footer')
    @yield('scripts')
</div>
</body>
</html>
