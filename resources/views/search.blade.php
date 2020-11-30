@extends('layouts.default')
@section('title', 'Search Results')
@section('content')
<div class="ui container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Search Results for {{$data['query']}}</h1>
    @if ($users->count()>0)
    <h3 class="ui blue header"><i class="right angle blue icon"></i>Members</h3>
    <div class="ui large feed">
        @foreach ($users as $user)
        <div class="ui segment event" style="padding:20px;">
            <div class="label">
                <i class="user outline blue icon"></i>
            </div>
            <div class="content">
                <div class="summary">
                    <a href="{{$user->path}}">{{$user->name}}</a>
                </div>
                <div class="extra text">
                    {{$user->country->name}}
                    @if($user->owned_entities->first())
                    , <a href="{{$user->owned_entities->first()->path}}">
                        {{$user->owned_entities->first()->name}}
                    </a>
                    @endif
                </div>
                <div class="meta">
                    <a class="like" href="{{$user->path}}">
                        <i class="right double arrow icon"></i> Visit
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($entities->count()>0)
    <h3 class="ui blue header"><i class="right angle blue icon"></i>Companies</h3>
    <div class="ui large feed">
        @foreach ($entities as $entity)
        <div class="ui segment event" style="padding:20px;">
            <div class="label">
                <i class="university blue icon"></i>
            </div>
            <div class="content">
                <div class="summary">
                    <a href="{{$entity->path}}">
                        {{$entity->name}} {{$entity->name_additional? ', '.$entity->name_additional:''}}
                    </a>
                    <div class="date">
                        {{$entity->created_at->diffForHumans()}}
                    </div>
                </div>
                <div class="extra text">
                    {{$entity->type->name}}, {{$entity->primary_country->name}}
                </div>
                <div class="meta">
                    <a class="like" href="{{$entity->path}}">
                        <i class="right double arrow icon"></i> Visit
                        </href=>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @if($posts->count()>0)
    <h3 class="ui blue header"><i class="right angle blue icon"></i>Posts</h3>
    <div class="ui large feed">
        @foreach ($posts as $post)
        <div class="ui segment event" style="padding:20px;">
            <div class="label">
                <i class="file outline blue icon"></i>
            </div>
            <div class="content">
                <div class="summary">
                    By <a href="{{route('profile.show', $post->user->id)}}">{{$post->user->name}}</a>
                    <div class="date">
                        {{$post->created_at->diffForHumans()}}
                    </div>
                </div>
                <div class="extra text">
                    {{Illuminate\Support\Str::limit($post->content,250)}}
                </div>
                <div class="meta">
                    <a class="like" href="{{route('home')}}?id={{$post->id}}">
                        <i class="right double arrow icon"></i> Visit
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @if ($users->count()==0 && $entities->count()==0 && $posts->count() ==0)
    <div class="ui very padded basic segment">
        <i class="circular inverted blue info small icon"></i> No results found for your query, please try another query
    </div>
    @endif

</div>
@endsection