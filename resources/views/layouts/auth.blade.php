<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.partials.header')
</head>
<body>
    @include('admin.partials.navigation')
    @include('partials.flash-message')
    @yield('content')
    @yield('scripts')
</body>
</html>
