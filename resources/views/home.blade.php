@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui sixteen wide column stackable grid">
            <div class="nine wide column">
                <h1 class="ui blue header">My Profile</h1>
                <div class="ui image">
                    @if($user->avatar()->exists())
                        <img class="ui circular small image" src="{{$user->avatar()->thumbnail()->url}}" alt="">
                    @else
                        <i class="circular user inverted grey huge icon"></i>
                    @endif
                </div>
                <h2 class="ui blue header">{{$user->name}}</h2>
                @if($user->entities()->exists())
                    <p class="comment">{{$user->entities()->first()->name}}</p>
                @else
                    <p class="comment">No registered organizations yet</p>
                    <a href="#" class="ui teal button">Register a new organization</a>
                @endif
            </div>
        </div>
    </div>
@endsection
