@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui eight wide column stackable grid">
            <div class="ui centered center aligned one wide column">
                <div class="ui card">
                    <div class="header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}</div>

                    <div class="content">
                        @isset($url)
                            <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}"></form>
                                @else
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}"></form>
                        @endisset
                        @csrf

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
