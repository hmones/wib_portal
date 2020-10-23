@extends('layouts.default')
@section('title', 'Home Page')
@section('content')
<div class="ui container">

    @forelse ($posts as $post)
    <div class="ui relaxed divided list">
        <div class="ui raised padded segment">
            <div class="floating ui circular red label" style="padding-left:3px !important;"><i class="delete icon"></i>
            </div>
            <div class="ui grid">
                <div class="twelve wide column">
                    <img class="ui avatar image"
                        src="{{$post->user->avatar()->url??'https://www.flaticon.com/svg/static/icons/svg/147/147144.svg'}}"
                        alt="" />
                    <a href="javascript:void(0)">{{$post->user->name}}</a>
                </div>
                <div class="three wide right floated right aligned column">
                    <i class="clock outline icon"></i> {{$post->created_at->diffForHumans()}}
                </div>
            </div>
            <div class="ui basic segment">
                {{$post->content}}
                @if($post->image)
                <div class="ui divider"></div>
                <img class="ui image" src="{{$post->image}}" alt="">
                @endif
            </div>

        </div>
    </div>
    @empty
    <i class="info inverted blue icon"></i> No posts yet!, please visit back again soon!
    @endforelse

</div>
@endsection