@extends('layouts.default')

@section('content')
    <br><br>
    <div class="ui centered container">
        <div class="ui grid">
            <div class="ui blue header breadcrumb">
                <a class="section" href="{{route('entity.index')}}">Organizations</a>
                <i class="right angle icon divider"></i>
                <a class="active section" href="{{route('entity.show', $entity)}}">{{$entity->name}}</a>
            </div>
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
            <div class="five wide column">
                <div class="ui left aligned basic segment">
                    @isset($entity->phone)
                        <p><i class="phone blue icon"></i>Tel: +({{$entity->phone_country_code??'00'}}
                            )&nbsp;{{$entity->phone}}</p>
                    @endisset
                    @isset($entity->primary_email)
                        <p><i class="at blue icon"></i>Email: <a
                                href="{{$entity->primary_email??'#'}}">{{$entity->primary_email}}</a></p>
                    @endisset
                </div>
            </div>
        </div>
        <br><br><br><br>
        <div class="ui stackable grid">
            <div class="five wide column">
                <h4 class="ui blue header">Members</h4>
                <div class="ui divider"></div>
                <div class="ui list">
                    @forelse($entity->users as $user)
                        <div class="item">
                            <img class="ui avatar image" src="
                                @if($user->avatar()->exists())
                            {{$user->avatar()->smallthumbnail()->url}}
                            @else
                            @if($user->gender === 'Male')
                            {{asset('images/male_avatar.jpg')}}
                            @else
                            {{asset('images/female_avatar.jpg')}}
                            @endif
                            @endif
                                ">
                            <div class="content">
                                <a href="{{route('profile.show',$user)}}" class="header">{{$user->name}}</a>
                                <div class="description">{{$user->pivot->relation_type}}</div>
                            </div>
                        </div>
                    @empty
                        <div class="ui comment">
                            <i class="info circle teal icon"></i> No information to show!
                        </div>
                    @endforelse
                </div>

            </div>
            <div class="five wide column">
                <h4 class="ui blue header">Fields of Activity</h4>
                <div class="ui divider"></div>
                @foreach($entity->sectors as $sector)
                    <div>
                    <!--                             <i class="{{$sector->icon}} blue icon"></i> -->
                        {{$sector->name}}
                    </div>
                @endforeach

                <h4 class="ui blue header">Business Activity</h4>
                <div class="ui divider"></div>
                @if($entity->activity)
                    {{$entity->activity}}
                @else
                    <i class="info circle teal icon"></i> No information to show!
                @endif
            </div>
            <div class="five wide column">
                <h4 class="ui blue header">Locations</h4>
                <div class="ui divider"></div>
                <i class="map marker alternate teal icon"></i> Primary Address
                <div class="ui basic segment">
                    {{$entity->primary_address}} <br> {{$entity->primary_city->name}}
                    <br>{{$entity->primary_country->name}}
                </div>
                <div class="ui divider"></div>
                <i class="map marker alternate teal icon"></i> Secondary Address
                <div class="ui basic segment">
                    @if($entity->secondary_address)
                        {{$entity->secondary_address ?? ""}}
                        <br>
                        {{$entity->secondary_city->name ?? ""}}
                        <br>
                        {{$entity->secondary_country->name ?? ""}}
                    @else
                        <i class='info circle teal icon'></i> No secondary address available
                    @endif
                </div>

            </div>
        </div>

    </div>
    <br><br><br>

@endsection
