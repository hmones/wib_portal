@extends('layouts.default')
@section('title', 'Organizations and Businesses')
@section('content')
<div class="ui centered container">
    <div class="ui right floated basic segment" style="padding: 0;">
        <a class="ui right labeled grey icon large button" href="javascript:void(0);"
            onclick="$('#filter_form').toggle(500);">
            <i class="filter teal icon"></i>
            <span style="color:#1a4d99">Filter</span>
        </a>
    </div>
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>
        @if(request()->get('type') === 'organization')
        Organizations in the Network
        @elseif(request()->get('type') === 'business')
        Companies in the Network
        @else
        Companies and Organizations in the Network
        @endif
    </h1>
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
