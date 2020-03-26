<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.partials.header')
</head>
<body class="ui inverted basic segment">
<div id="app">
    @yield('content')
</div>
</body>
</html>
