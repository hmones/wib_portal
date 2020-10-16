@extends('layouts.default')
@section('title', 'Edit business or organization details')
@section('content')
<div class="ui container">
    <h1 class="ui blue header">
        Edit business or organization's details
    </h1>
    @include('partials.entity.registrationForm', $entity)
    <br><br>
</div>
@endsection

@section('scripts')
<script>
    let app_url = "{{url('/')}}";
        let entity_store_url = "{{route('entity.update', $entity)}}";
        let entities_url = "{{route('profile.entities')}}";
        let profile_picture_store_url = "{{route('profilepicture.store')}}";
        let app_token = "{{Session::token()}}";
        let entity_photos_url = "{{route('image.upload', ['entity'=>$entity])}}";
        $(function() {
            $('div.tooltip').popup();
        });
</script>
<script src="{{asset('js/entity.create.js')}}" type="application/javascript"></script>
<script src="{{asset('js/entity.upload.photos.js')}}"></script>
@endsection