@extends('layouts.default')
@section('title','Registered members')
@section('content')
<div class="ui centered container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered members</h1>
    <br>
    @include('partials.filter_section', ['route' => route('profile.index')])
    <br><br>
    <div class="ui four column stackable grid" id="profiles_list">
        @include('partials.profile.list', $users)
    </div>
</div>
<br><br><br>
<br><br>

@endsection

@section('scripts')
<script>
    var url = "{{route('profiles.get.api')}}";
    var last_page = {{$users->lastPage()}};
    var app_token = "{{Session::token()}}";
    var main_container = "#profiles_list";
</script>
<script src="{{asset('js/loadResources.js')}}" type="application/javascript"></script>
@endsection