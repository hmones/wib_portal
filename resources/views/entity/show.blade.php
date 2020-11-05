@extends('layouts.default')
@section('title', $entity->name)
@section('content')
<br><br>
<div class="ui centered container">
    <div class="ui stackable grid">
        <h2 class="ui blue header breadcrumb">
            <a class="section" href="{{route('entity.index')}}">Organizations</a>
            <i class="right angle icon divider"></i>
            <a class="active section" href="{{route('entity.show', $entity)}}">{{$entity->name}}</a>
        </h2>
    </div>
    <br><br><br>
    <div class="ui stackable middle aligned grid">
        <div class="three wide column">
            <img class="ui circular small image" src="
                @if($entity->logo()->exists())
                {{$entity->logo()->thumbnail()->url}}
                @else
                {{asset('images/logo_avatar.png')}}
                @endif
                    " alt="{{$entity->name}}'s logo">
        </div>
        <div class="six wide column">
            <p><i class="{{$entity->type->icon}} teal icon"></i> {{strtoupper($entity->type->name)}}</p>
            <h1 style="margin: 0px;" class="ui blue header">{{$entity->name}}</h1>
            <p>{{strtoupper($entity->primary_country->name)}}</p>
            @foreach($entity->links as $link)
            <a href="{{$link->url}}"> <i class="circular blue {{$link->type->icon}} icon"></i> </a>
            @endforeach

        </div>
        <div class="right floated four wide column">
            @auth
            <div class="ui stackable grid">
                <div class="row">
                    <div class="two wide column">
                        <i class="mobile alternate blue icon"></i>
                    </div>
                    <div class="fourteen wide column">
                        @isset($entity->phone)
                        +({{$entity->phone_country_code??'00'}})&nbsp;{{$entity->phone}}
                        @else
                        No phone available
                        @endisset
                    </div>
                </div>
                <div class="row">
                    <div class="two wide column">
                        <i class="at blue icon"></i>
                    </div>
                    <div class="fourteen wide column">
                        @isset($entity->phone)
                        <a href="{{$entity->primary_email??'#'}}">{{$entity->primary_email}}</a>
                        @else
                        No email available
                        @endisset
                    </div>
                </div>
            </div>
            @endauth
            @guest
            <div class="ui center aligned placeholder" style="border:1px #ececec solid;border-radius:15px;">
                <div class="paragraph">
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="paragraph">
                    <div class="ui center aligned basic segment">To view contact information <a
                            href="{{route('home')}}">login</a> or <a href="{{route('profile.create')}}">signup</a></div>
                </div>
                <div class="paragraph">
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
            @endguest

        </div>

    </div>
    <br><br><br><br>
    <div class="ui stackable grid">
        <div class="five wide column">
            <h4 class="ui blue header"><i class="stop wib bullet icon"></i>Members</h4>
            @auth
            <div class="ui very relaxed divided list">
                @forelse($entity->users as $user)
                <div class="item">
                    @include('partials.components.avatar', ['user' => $user, 'type' => 'user'])
                    <div class="middle aligned content">
                        <a href="{{route('profile.show',$user)}}"
                            class="header">{{\Illuminate\Support\Str::limit($user->name, 30,$end='..')}}</a>
                        <div class="description">{{$user->pivot->relation_type}}</div>
                    </div>
                </div>
                @empty
                <div class="ui comment">
                    <i class="info circle teal icon"></i> No information to show!
                </div>
                @endforelse
            </div>
            @endauth

            @guest
            <div class="ui placeholder" style="border:1px #ececec solid;border-radius:15px;">
                <div class="paragraph">
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="paragraph">
                    <div class="ui center aligned basic segment">To view members <a href="{{route('home')}}">login</a>
                        or <a href="{{route('profile.create')}}">signup</a></div>
                </div>
                <div class="paragraph">
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
            @endguest

        </div>
        <div class="five wide column">
            <h4 class="ui blue header"><i class="stop wib bullet icon"></i>Fields of Activity</h4>
            <div class="ui grey message">
                @foreach($entity->sectors as $sector)
                <div>
                    <!--                             <i class="{{$sector->icon}} blue icon"></i> -->
                    {{$sector->name}}
                </div>
                @endforeach
            </div>

            <h4 class="ui blue header"><i class="stop wib bullet icon"></i>Business Activity</h4>
            <div class="ui grey message">
                @if($entity->activity)
                {{$entity->activity}}
                @else
                <i class="info circle teal icon"></i> No information to show!
                @endif
            </div>
        </div>
        <div class="five wide column">
            <h4 class="ui blue header"><i class="stop wib bullet icon"></i>Locations</h4>
            <div class="ui grey message">
                {{$entity->primary_address}} <br> {{$entity->primary_city->name}}
                <br>{{$entity->primary_country->name}}
            </div>

            @if($entity->secondary_address)
            <div class="ui divider"></div>
            <div class="ui grey message">
                {{$entity->secondary_address ?? ""}}
                <br>
                {{$entity->secondary_city->name ?? ""}}
                <br>
                {{$entity->secondary_country->name ?? ""}}
            </div>
            @endif

        </div>
    </div>
    <div class="ui six column stackable grid">
        @if($entity->photos()->exists())
        <div class="sixteen wide column">
            <h4 class="ui dividing header">Product Photos</h4>
        </div>
        @foreach($entity->photos()->get() as $photo)
        <div class="column">
            <a href="javascript:void(0);" onclick="$('#image_{{$photo->id}}').modal('show');"><img class="ui image"
                    src="{{$photo->thumbnail}}" alt="">
                <div class="ui center aligned basic segment">
                    {{$photo->comment}}
                </div>
            </a>
            <div class="ui basic modal" id="image_{{$photo->id}}">
                <div class="ui center aligned basic segment">
                    <img src="{{$photo->url}}" alt="">
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>

</div>
<br><br><br>

@endsection