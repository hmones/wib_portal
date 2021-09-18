@extends('layouts.default')
@section('title', $entity->name)

@section('content')
    @include('partials.semantic-component', ['componentName' => 'rating'])
    @include('partials.semantic-component', ['componentName' => 'modal'])
    <br>
    <div class="ui centered container">
        <div class="ui stackable grid">
            <h2 class="ui breadcrumb">
                <a class="section byline" href="{{route('entity.index')}}">Organizations</a>
                <div class="divider byline"><i class="right angle icon"></i></div>
                <a class="active section byline" href="{{$entity->path}}">{{$entity->name}}</a>
            </h2>
        </div>
        <br><br><br>
        <div class="ui stackable middle aligned grid">
            <div class="two wide column">
                <img class="ui circular small image" src="
                @if($entity->image)
                {{$entity->image}}
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
                    <div class="ui stackable grid left-bordered basic segment">
                        <div class="row">
                            <div class="twelve wide column">
                                <i class="mobile alternate blue icon"></i>
                                @isset($entity->phone)
                                    +({{$entity->phone_country_code??'00'}})&nbsp;{{$entity->phone}}
                                @else
                                    <span style="color: #a7a7a7;">No phone available</span>
                                @endisset
                            </div>
                        </div>
                        <div class="row" style="padding-top:0px;">
                            <div class="twelve wide column">
                                <i class="at blue icon"></i>
                                @isset($entity->phone)
                                    <a href="mailto:{{$entity->primary_email??'#'}}">{{$entity->primary_email}}</a>
                                @else
                                    <span style="color: #a7a7a7;">No email available</span>
                                @endisset
                            </div>
                        </div>
                        @if(optional($entity->type)->name === 'Business')
                            <div class="row" style="padding-top:0px;">
                                <div class="twelve wide column">
                                    <i class="shopping cart blue icon"></i>
                                    @if($entity->ecommerce_link)
                                        <a href="{{$entity->ecommerce_link??'#'}}">Store</a> &nbsp;
                                        <div class="ui orange star rating"
                                             data-rating="{{floor($entity->ecommerce_rating)}}"
                                             data-max-rating="5">
                                        </div>
                                    @else
                                        <span style="color: #a7a7a7;">No store available</span>
                                    @endif
                                </div>
                            </div>
                        @endif
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
                                    href="{{route('home')}}">login</a> or <a
                                    href="{{route('profile.create')}}">signup</a>
                            </div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                @endguest

            </div>
        </div>
        <br><br><br>
        <div class="ui stackable grid">
            <div class="four wide column">
                <h4 class="ui blue header">Members</h4>
                @auth
                    <div class="ui very relaxed list">
                        @forelse($entity->users as $user)
                            <div class="item">
                                @include('partials.components.avatar', ['user' => $user, 'type' => 'user'])
                                <div class="middle aligned content">
                                    <a href="{{$user->path}}"
                                       class="header">{{Str::limit($user->name, 30,$end='..')}}</a>
                                    <div class="description">{{$user->pivot->relation_type}}</div>
                                </div>
                            </div>
                        @empty
                            <span style="color: #a7a7a7;">Not provided</span>
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
            <div class="four wide column">
                <h4 class="ui blue header">Fields of Activity</h4>
                <div class="ui left-bordered basic segment">
                    @foreach($entity->sectors as $sector)
                        <div>
                            {{$sector->name}}
                        </div>
                    @endforeach
                </div>
                <h4 class="ui blue header">Business Activity</h4>
                <div class="ui left-bordered basic segment">
                    @if($entity->activity)
                        {{$entity->activity}}
                    @else
                        <span style="color: #a7a7a7;">Not provided</span>
                    @endif
                </div>
            </div>
            <div class="four wide column">
                <h4 class="ui blue header">Address</h4>
                <div class="ui left-bordered basic segment">
                    <i class="map marker alternate icon"></i>
                    {{$entity->primary_address}}, {{$entity->primary_city->name}}, {{$entity->primary_country->name}}
                    @if($entity->secondary_address)
                        <div class="ui hidden divider"></div>
                        <i class="map marker alternate icon"></i>
                        {{$entity->secondary_address ?? ''}} {{$entity->secondary_city->name ?? ''}} {{$entity->secondary_country->name ?? ''}}
                    @endif
                </div>
            </div>
        </div>
        <div class="ui six column stackable grid">
            @if($entity->photos()->exists())
                <div class="sixteen wide column">
                    <h4 class="ui dividing header">Product Photos</h4>
                </div>
                @foreach($entity->photos()->get() as $photo)
                    <div class="column">
                        <a href="javascript:void(0);" onclick="$('#image_{{$photo->id}}').modal('show');"><img
                                class="ui image"
                                src="{{$photo->thumbnail}}" alt="">
                            <div class="ui center aligned basic segment">
                                {{$photo->comment}}
                            </div>
                        </a>
                        <div class="ui basic modal" id="image_{{$photo->id}}">
                            <div class="ui center aligned basic segment">
                                <img class="ui image" src="{{$photo->url}}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
    <br><br><br>

@endsection

@push('additional_scripts')
    <script>
        $(function () {
            $('.ui.rating').rating('disable');
        });
    </script>
@endpush
