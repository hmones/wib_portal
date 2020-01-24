<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Women in Business Portal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/semantic.min.css')}}" rel="stylesheet" type="text/css">
        <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
        <script type="application/javascript" src="{{asset('js/semantic.min.js')}}"></script>


    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="ui container">
                <div class="ui middle aligned centered basic segment">
                    <h1 class="ui header">Registration form for Women in Business</h1>
                    <form action="{{route('profile/create')}}" class="ui form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="file" name="avatar">
                        <input type="submit" class="ui teal button">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
