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
                <form class="ui form" method="POST" action="{{ route('password.update') }}">
                    <div class="ui horizontal divider header">Reset password</div>
                    <br>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="required field">
                        <input id="email" type="email" placeholder="Enter your registered email address" name="email"
                               value="{{$email ?? old('email')}}" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="ui negative message">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="required field">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password">
                        @error('password')
                        <div class="ui negative message" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="required field">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" name="password_confirmation" required
                                   autocomplete="new-password">
                        </div>
                    </div>
                    <div class="field">
                        <button type="submit" class="ui basic blue fluid button">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
