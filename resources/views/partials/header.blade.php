@if (session('statistics'))
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76515214-2"></script>
<script>
      window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-76515214-2');
</script>
@endif


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Women in Business Portal | Users Listing</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link href="{{asset('dist/semantic.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('dist/jquery-3.1.1.min.js')}}"></script>
<script type="application/javascript" src="{{asset('dist/semantic.min.js')}}"></script>
<!-- Scripts -->
<script src="{{ asset('js/ui.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<link rel="apple-touch-icon" sizes="180x180"
      href="https://gpp-wib-staging.frb.io/assets/img/favicons/wib/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32"
      href="https://gpp-wib-staging.frb.io/assets/img/favicons/wib/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16"
      href="https://gpp-wib-staging.frb.io/assets/img/favicons/wib/favicon-16x16.png">
<link rel="manifest" href="https://gpp-wib-staging.frb.io/assets/img/favicons/wib/site.webmanifest">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">