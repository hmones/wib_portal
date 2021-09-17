@extends('layouts.default')
@section('title','Registered members')
@section('content')
    <div class="ui centered container">
        <h1 class="ui blue page header">Business Directory</h1>
        <div class="page subheader">
            Browse members of the portal
        </div>
        <div class="ui hidden divider"></div>
        <a href="javascript:void(0);" onclick="$('#filter_form').toggle(500);">
            <span class="ui blue text">Filter results <i class="sort down icon"></i></span>
        </a>
        <div class="ui hidden divider"></div>
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
