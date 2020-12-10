@extends('layouts.default')
@section('title','Registered members')
@section('content')
<div class="ui centered container">
    <div class="ui right floated basic segment" style="padding: 0;">
        <a href="javascript:void(0);" onclick="$('#filter_form').toggle(500);"
            class="ui right labeled grey icon large button">
            <i class="filter teal icon"></i><span style="color:#1a4d99">Filter</span>
        </a>
    </div>
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Members in the Network</h1>
    @include('partials.filter_section', ['route' => route('profile.index'), 'recent_online' => true])
    <br>
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