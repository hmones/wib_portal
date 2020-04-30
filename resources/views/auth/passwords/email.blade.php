@extends('layouts.default')

@section('content')
    <div class="ui container">
        @if (session('status'))
            <div class="ui positive message" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="ui stackable grid">
        <div class="centered three wide column">
            <div class="ui very padded left aligned basic segment">

                <form class="ui form" method="POST" action="{{ route('password.email') }}">
                    <div class="ui blue header">Reset password</div>
                    <div class="ui divider"></div>
                    @csrf
                    <div class="required field">
                        <input id="email" type="email" placeholder="Enter your registered email address" name="email"
                               value="" required autocomplete="email" autofocus>
                    </div>
                    <div class="field">
                        <button type="submit" class="ui basic blue fluid button">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
