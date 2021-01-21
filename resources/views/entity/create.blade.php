@extends('layouts.default')
@section('title', 'Register a new business or organization')
@section('content')
<div class="ui container">
    <h1 class="ui blue header">
        Register a new business or organization
    </h1>
    @include('partials.entity.registrationForm')
    <br><br>
</div>
@endsection

@section('scripts')
<script>
    let app_url = "{{url('/')}}";
    let entity_store_url = "{{route('entity.store')}}";
    let entities_url = "{{route('profile.entities')}}";
    let app_token = "{{Session::token()}}";
    let photos_store_url = "{{route('photos.store')}}";
</script>
<script src="{{asset('js/entity.create.js')}}" type="application/javascript"></script>
<script src="{{asset('js/entity.upload.photos.js')}}"></script>
@endsection