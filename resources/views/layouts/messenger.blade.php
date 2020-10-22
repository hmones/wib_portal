<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.header')
    {{-- Meta tags --}}
    <meta name="route" content="{{ $route }}">
    <meta name="url" content="{{ url('').'/'.config('chatify.path') }}" data-user="{{ Auth::user()->id }}">

    {{-- scripts --}}
    <script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
    <script src="{{ asset('js/chatify/autosize.js') }}"></script>
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    {{-- styles --}}
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
    <link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/chatify/messenger-color.css') }}" rel="stylesheet" />
</head>

<body>
    @include('partials.navigation')
    @include('partials.flash-message')
    @yield('content')
    @include('partials.footer')
    @yield('scripts')
    @yield('styles')
</body>

</html>