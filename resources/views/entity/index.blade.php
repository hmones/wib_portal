@extends('layouts.default')
@section('title', 'Organizations and Businesses')
@section('content')
    <div class="ui centered container">
        <h1 class="ui blue page header">
            Companies Directory
        </h1>
        <div class="page subheader">
            Browse companies in the network
        </div>
        <div class="ui hidden divider"></div>
        <a href="javascript:void(0);" onclick="$('#filter_form').toggle(500);">
            <span class="ui blue text">Filter Results <i class="sort down icon"></i></span>
        </a>
        <div class="ui hidden divider"></div>
        @include('partials.filter_section', ['route' => route('entity.index'), 'recent_online' => false])
        <br>
        <div class="ui four column stackable grid" id="entities_list">
            @include('partials.entity.list', $entities)
        </div>
    </div>
    <br><br><br>

@endsection
@section('scripts')
    <script>
        let url = "{{route('entities.get.api')}}";
        let last_page = {{$entities->lastPage()}};
        let app_token = "{{session()->token()}}";
        let main_container = "#entities_list";
    </script>
    <script src="{{asset('js/loadResources.js')}}" type="application/javascript"></script>
@endsection
