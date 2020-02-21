@extends('layouts.default')

@section('content')
    <div class="ui stackable grid">
        <div class="centered three wide column">
            <div class="ui very padded left aligned raised segment">
                @if (session('status'))
                    <div class="ui negative message" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="ui form" method="POST" action="{{ route('password.email') }}">
                    <div class="ui horizontal divider header">Reset password</div>
                    <br>
                    @csrf
                    <div class="required field">
                        <input id="email" type="email" placeholder="Enter your registered email address" name="email"
                               value="" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="ui negative message">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        </div>
                        @enderror
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
