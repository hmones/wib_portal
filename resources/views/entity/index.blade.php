@extends('layouts.default')
@section('title', 'Organizations and Businesses')
@section('content')
<div class="ui centered container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered Businesses and Organizations</h1>
    <br>
    @include('partials.filter_section', ['route' => route('entity.index')])
    <br><br>
    <div class="ui four column stackable grid" id="entities_list">
        @include('partials.entity.list', $entities)
    </div>
</div>
<br><br><br>

@endsection
@section('scripts')
<script>
    var url = "{{route('entities.get.api')}}";
    var last_page = {{$entities->lastPage()}};
    var app_token = "{{Session::token()}}";
    var main_container = "#entities_list";
</script>
<script src="{{asset('js/loadResources.js')}}" type="application/javascript"></script>
@endsection