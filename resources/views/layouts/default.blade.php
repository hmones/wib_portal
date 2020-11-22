<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.header')
</head>

<body>
    @include('partials.navigation')
    @include('partials.flash-message')
    @yield('content')
    @include('partials.footer')
    @yield('scripts')
    @stack('additional_scripts')
    @yield('styles')
</body>

</html>