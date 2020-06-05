@extends('layouts.default')

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
        let profile_picture_store_url = "{{route('profilepicture.store')}}";
        let app_token = "{{Session::token()}}";
        $(function() {
            $('div.tooltip').popup();
        });
    </script>
    <script src="{{asset('js/entity.create.js')}}" type="application/javascript"></script>
@endsection
