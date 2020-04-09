@extends('layouts.default')

@section('content')
    <div class="ui centered container">
        <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered members</h1>
        <br>
        @include('partials.filter_section')
        <br><br>
        <div class="ui four column stackable grid">
            @forelse($users as $user)
                @include('partials.profile_card', $user)
            @empty
                <div class="ui centered center aligned header"><i class="info circle teal icon"></i>No registered
                    members to display
                </div>
            @endforelse
        </div>
    </div>
    <br><br><br>
    <div class="ui centered grid">
        <div class="ui centered basic segment">
            {{ $users->appends($_GET)->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
    <br><br>

@endsection
