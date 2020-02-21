@extends('layouts.default')

@section('content')
    <br><br>
    <div class="ui centered container">
        <div class="ui grid">
            <div class="ui blue header breadcrumb">
                <a class="section" href="{{route('profile.index')}}">Members</a>
                <i class="right angle icon divider"></i>
                <a class="active section" href="{{route('profile.show', $user)}}">{{$user->name}}</a>
            </div>
        </div>
        <br><br><br>
        <div class="ui stackable middle aligned stackable grid">
            <div class="three wide column">
                <img class="ui circular small image" src="
                @if($user->avatar()->exists())
                {{$user->avatar()->thumbnail()->url}}
                @else
                @if($user->gender === 'Male')
                {{asset('images/male_avatar.jpg')}}
                @else
                {{asset('images/female_avatar.jpg')}}
                @endif
                @endif
                    " alt="{{$user->name}}'s avatar">
            </div>
            <div class="six wide column">
                <p>{{strtoupper($user->sectors()->first()->name)}}</p>
                <h1 style="margin: 0px;" class="ui blue header">{{$user->title}} {{$user->name}}</h1>
                <p>{{strtoupper($user->country->name)}}</p>
                @foreach($user->links as $link)
                    <a href="{{$link->url}}"> <i class="circular blue {{$link->type->icon}} icon"></i> </a>
                @endforeach
            </div>
            <div class="seven wide column">
                <form action="{{route('profile.contact', ['profile'=>$user])}}" method="POST">
                    @csrf
                    <button type="submit" class="ui right floated top aligned blue button"><i class="envelope icon"></i>Contact
                        member
                    </button>
                </form>
            </div>
        </div>
        <br><br><br><br>
        <div class="ui stackable grid">
            <div class="five wide column">
                <h4 class="ui blue header">User's Organizations</h4>
                <div class="ui divider"></div>
                <div class="ui relaxed divided list">
                    @forelse($user->entities as $entity)
                        <div class="item">
                            <img class="ui avatar image" src="
                            @if($entity->logo()->exists())
                            {{$entity->logo()->smallthumbnail()->url}}
                            @else
                            {{asset('images/logo_avatar.png')}}
                            @endif
                                ">
                            <div class=" top aligned content">
                                <a href="{{route('entity.show',$entity)}}" class="header">{{$entity->name}}</a>
                                <div class="description">{{$entity->pivot->relation_type}}</div>
                            </div>
                        </div>
                    @empty
                        <div class="ui comment">
                            <i class="info circle teal icon"></i> No information to show!
                        </div>
                    @endforelse
                </div>

            </div>
            <div class="seven wide column">
                <h4 class="ui blue header">Profile</h4>
                <div class="ui divider"></div>
                @if($user->bio)
                    {{$user->bio}}
                @else
                    <i class="info circle teal icon"></i> No information to show!
                @endif

            </div>
            <div class="four wide column">
                <h4 class="ui blue header">Field of work</h4>
                <div class="ui divider"></div>
                @foreach($user->sectors as $sector)
                    <div>
                        <i class="{{$sector->icon}} blue icon"></i> {{$sector->name}}
                    </div>
                @endforeach

            </div>
        </div>

    </div>
    <br><br><br>

@endsection
