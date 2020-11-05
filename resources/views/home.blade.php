@extends('layouts.default')
@section('title', 'Home Page')
@section('content')
<div class="ui container" id="posts_container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Member Space</h1>
    @include('partials.posts.new')
    <div id="new_posts"></div>
    @include('partials.posts.list', $posts)
    <div id="extra_posts"></div>
</div>
@endsection
@section('scripts')
<script>
    var posts_url = "{{route('posts.get.api')}}";
    var app_token = "{{Session::token()}}";
</script>
<script src="{{asset('js/post.posts.js')}}" type="application/javascript"></script>
@endsection