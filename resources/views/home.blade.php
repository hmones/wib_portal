@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui four column stackable grid">
            <div class="ui row">
                <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered members</h1>
            </div>

            @forelse($users as $user)
                @include('partials.profile_card', $user)
            @empty
                <div class="ui centered center aligned header"><i class="info circle teal icon"></i>No registered
                    members to display
                </div>
            @endforelse
            <div class="ui row"></div>
            <div class="ui centered row">
                <a href="{{route('profile.index')}}" class="ui right labeled icon teal big button"> <i
                        class="right angle icon"></i> Show more</a>
            </div>
            <div class="ui row"></div>
            <div class="ui row">
                <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered Businesses and Organizations
                </h1>
            </div>
            @forelse($entities as $entity)
                @include('partials.entity.card', $entity)
            @empty
                <div class="ui centered center aligned header"><i class="info circle teal icon"></i> No businesses or
                    organizations to display
                </div>
            @endforelse
            <div class="ui row"></div>
            <div class="ui centered row">
                <a href="{{route('entity.index')}}" class="ui right labeled icon teal big button"> <i
                        class="right angle icon"></i> Show more</a>
            </div>
        </div>
        <br><br>
        <br>
    </div>
@endsection
