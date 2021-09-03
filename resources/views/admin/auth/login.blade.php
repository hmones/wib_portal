@extends('layouts.authLogin')

@section('content')
    <br><br>
    <div class="ui stackable grid">
        <div class="centered three wide column">
            <div class="ui very padded center aligned raised inverted segment">
                <br><br>
                <div class="ui image">
                    <img class="ui image" src="{{asset('images/logo.png')}}" style="filter:invert(0.85);" alt="">
                </div>
                <br><br>
                <form class="ui form" method="POST" action="{{route('admin.')}}">
                    @csrf
                    <div class="field">
                        <input
                            class="form-control"
                            name="email"
                            placeholder="Email"
                            type="email"/>
                        @if ($errors->has('email'))
                            <div class="ui negative message">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="field">
                        <input
                            class="form-control"
                            name="password"
                            placeholder="Password"
                            type="password"/>
                        @if ($errors->has('password'))
                            <div class="ui negative message">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                    <button class="ui primary fluid button" type="submit">Login</button>

                </form>

            </div>
        </div>
    </div>

    <br><br>
@endsection
