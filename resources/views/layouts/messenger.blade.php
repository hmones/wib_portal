<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.header')
    {{-- Meta tags --}}
    <meta name="route" content="{{ $route }}">
    <meta name="url" content="{{ url('').'/'.config('messenger.path') }}" data-user="{{ Auth::user()->id }}">

    {{-- scripts --}}
    <script src="{{ asset('js/messenger/font.awesome.min.js') }}"></script>
    <script src="{{ asset('js/messenger/autosize.js') }}"></script>
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    {{-- styles --}}
    <link href="{{ asset('css/messenger.css') }}" rel="stylesheet"/>
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
