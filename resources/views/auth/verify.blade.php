@extends('layouts.default')
@section('title','Verify Email')
@section('content')
<div class="ui container">
    <div class="ui very padded center aligned basic segment">
        <div class="ui header">{{ __('Verify Your Email Address') }}</div>

        <div class="ui basic segment">
            @if (session('resent'))
            <div class="ui positive message" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            <br><br>
            {{ __('If you did not receive the email') }},
            <br><br>
            <form class="" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="ui blue button">{{ __('Request verification Email') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection