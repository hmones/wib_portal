@extends('layouts.default')

@section('content')
    <br><br>
    <div class="ui stackable grid">
        <div class="centered three wide column">
            <div class="ui very padded left aligned raised segment">
                @include('partials.signin', ['url'=>'user'])
            </div>
        </div>
    </div>

    <br><br>
@endsection
