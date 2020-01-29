<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.header')
</head>
<body>
    @include('partials.navigation')
    @yield('content')
    @include('partials.footer')
</body>
    @yield('scripts')
</html>
