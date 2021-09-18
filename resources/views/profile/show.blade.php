@extends('layouts.default')
@section('title','Network Members')
@section('content')
    <br>
    <div class="ui centered container">
        <div class="ui grid">
            <h2 class="ui breadcrumb">
                <a class="section byline" href="{{route('profile.index')}}">Members</a>
                <div class="divider byline"><i class="right angle icon"></i></div>
                <a class="active section byline" href="{{$user->path}}">{{$user->name}}</a>
            </h2>
        </div>
        <br><br><br>
        <div class="ui stackable middle aligned stackable grid" id="userInfoHeader">
            <div class="two wide column">
                <img class="ui circular small image" src="
                    @if($user->image)
                {{$user->image}}
                @else
                @if($user->gender === 'Male')
                {{asset('images/male_avatar.jpg')}}
                @else
                {{asset('images/female_avatar.jpg')}}
                @endif
                @endisset
                    " alt="{{$user->name}}'s avatar"/>
            </div>
            <div class="six wide column">
                <p>{{strtoupper(optional($user->sectors->first())->name)}}</p>
                <h1 style="margin: 0px !important;" class="ui blue header" id="userNameTitle">{{$user->title}}
                    {{$user->name}}</h1>
                <p>{{strtoupper($user->country->name)}}</p>
                @foreach($user->links as $link)
                    <a href="{{$link->url}}"> <i class="circular blue {{$link->type->icon}} icon"></i> </a>
                @endforeach
            </div>
            <div class="four wide column">
                <a href="{{route('messenger')}}"
                   class="ui right labeled top aligned basic teal icon large button">
                    <i class="send icon"></i>
                    Message User
                </a>
            </div>
        </div>
        <br><br><br>
        <div class="ui stackable grid">
            <div class="four wide column">
                <h4 class="ui blue header">User's Organizations</h4>
                <div class="ui relaxed list">
                    @forelse($user->entities as $entity)
                        <div class="item">
                            @include('partials.components.avatar',['entity' => $entity, 'type' => 'entity'])
                            <div class="middle aligned content">
                                <a href="{{$entity->path}}"
                                   class="header">{{Str::limit($entity->name, 30,$end='..')}}</a>
                                <div class="description">{{$entity->pivot->relation_type}}</div>
                            </div>
                        </div>
                    @empty
                        <span style="color: #a7a7a7;">Not provided</span>
                    @endforelse
                </div>

            </div>
            <div class="four wide column">
                <h4 class="ui blue header">Profile</h4>
                <div class="ui left-bordered basic segment">
                    @if($user->bio)
                        {{$user->bio}}
                    @else
                        <span style="color: #a7a7a7;">Not provided</span>
                    @endif
                </div>
            </div>
            <div class="four wide column">
                <h4 class="ui blue header">Women Association</h4>
                <div class="ui left-bordered basic segment">
                    @if($association)
                        <a href="{{$association->path}}">
                            <img class="ui avatar image" src="
                                @if($association->image)
                            {{$association->image}}
                            @else
                            {{asset('images/logo_avatar.png')}}
                            @endif
                                ">
                            {{$association->name}}
                        </a>
                    @else
                        <span style="color: #a7a7a7;">Not provided</span>
                    @endisset
                </div>

                <h4 class="ui blue header">Field of work</h4>
                <div class="ui left-bordered basic segment">
                    @foreach($user->sectors as $sector)
                        <div>
                            {{$sector->name}}
                        </div>
                    @endforeach
                </div>


            </div>
        </div>

    </div>
    <br><br><br>

@endsection
