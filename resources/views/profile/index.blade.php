@extends('layouts.default')

@section('content')
    <br><br>
    <div class="ui centered container">
        <h1 class="ui blue header">Recently registered members</h1>
        <br>
        <div class="ui four column stackable grid">
            @forelse($users as $user)
                @include('partials.profile_card', $user)
            @empty
                <div class="ui centered center aligned header">There are currently no registered users</div>
            @endforelse
        </div>
    </div>
    <br><br><br>

@endsection
