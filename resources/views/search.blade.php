@extends('layouts.default')
@section('title', 'Search Results')
@section('content')
    <div class="ui container">
        <h1 class="ui blue page header">Search Results</h1>
        <div class="page subheader">
            Matching results for {{$data['query']}}
        </div>
        <p class="byline"></p>
        @if ($users->count()>0)
            <h3 class="ui blue header">Members</h3>
            <div class="ui large feed">
                @foreach ($users as $user)
                    <div class="ui raised segment event" style="padding:20px;margin-top:20px;">
                        <div class="label">
                            @include('partials.components.avatar', ['type'=>'user','user'=>$user, 'styles'=>'margin-top:17px;'])
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
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if($entities->count()>0)
            <h3 class="ui blue header">Companies</h3>
            <div class="ui large feed">
                @foreach ($entities as $entity)
                    <div class="ui raised segment event" style="padding:20px;margin-top:20px;">
                        <div class="label">
                            @include('partials.components.avatar', ['type'=>'entity','entity'=>$entity,
                            'styles'=>'margin-top:17px;'])
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
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if($posts->count()>0)
            <h3 class="ui blue header">Posts</h3>
            <div class="ui large feed">
                @foreach ($posts as $post)
                    <div class="ui raised segment event" style="padding:20px;margin-top:20px;">
                        <div class="label">
                            @include('partials.components.avatar', ['type'=>'user','user'=>$post->user,
                            'styles'=>'margin-top:17px;'])
                        </div>
                        <div class="content">
                            <div class="summary">
                                <a href="{{route('home')}}?id={{$post->id}}">Post</a> by <a
                                    href="{{$post->user->path}}">{{$post->user->name}}</a>
                                <div class="date">
                                    {{$post->created_at->diffForHumans()}}
                                </div>
                            </div>
                            <div class="extra text">
                                {{Illuminate\Support\Str::limit($post->content,250)}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($users->count()==0 && $entities->count()==0 && $posts->count() ==0)
            <div class="ui very padded basic segment">
                <i class="circular inverted blue info small icon"></i> No results found for your query, please try
                another query
            </div>
        @endif

    </div>
@endsection
