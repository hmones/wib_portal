<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.header')
    @yield('styles')
</head>

<body>
    @include('partials.navigation')
    @include('partials.flash-message')
    @yield('content')
    @include('partials.footer')
    @yield('scripts')
    @stack('additional_scripts')
</body>

</html>
