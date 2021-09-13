@if (session('statistics'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76515214-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-76515214-2');
    </script>
@endif


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Women in Business Portal | @yield('title')</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Fonts -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,600;0,700;1,400&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&display=swap');
</style>
<link href="{{asset('dist/semantic.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script type="application/javascript" src="{{asset('dist/semantic.min.js')}}"></script>
<!-- Scripts -->
<script src="{{ asset('js/ui.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<link rel="apple-touch-icon" sizes="180x180"
      href="{{asset('images/favicons/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32"
      href="{{asset('images/favicons/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16"
      href="{{asset('images/favicons/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('images/favicons/site.webmanifest')}}">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
