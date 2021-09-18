@extends('layouts.default')
@section('title', 'Members Space')
@section('content')
    <div class="ui container">
        @include('partials.posts.new')
    </div>
    <br/>
    <div class="ui container" id="posts_container">
        <div id="new_posts"></div>
        @include('partials.posts.list', $posts)
        <div id="extra_posts"></div>
    </div>
@endsection
@section('scripts')
    <script>
        var posts_url = "{{route('api.posts.index')}}";
        var app_token = "{{session()->token()}}";
    </script>
    <script src="{{asset('js/post.posts.js')}}" type="application/javascript"></script>
@endsection
