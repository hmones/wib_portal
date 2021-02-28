@extends('layouts.default')
@section('title', 'Login')
@section('content')
    <div class="ui stackable grid">
        <div class="centered three wide column">
            <div class="ui very padded left aligned basic segment">
                @include('partials.signin', ['url'=>'user'])
            </div>
        </div>
    </div>
@endsection