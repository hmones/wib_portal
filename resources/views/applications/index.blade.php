@extends('layouts.default')
@section('title','Signup for B2B event')
@section('content')
    <div class="ui container">
        <div class="ui stackable grid">
            <div class="seven wide column">
                <h1 class="ui page blue header">
                    Session booking, B2B events
                </h1>
                <div class="page subheader">
                    Join the B2B event as a client and connect to registered service providers.
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui three column doubling stackable grid container">
            @foreach($providers as $provider)
                <div class="column">
                    <div class="ui segment" style="padding:0;">
                        <div style="height: 285px; overflow: hidden;">
                            <img src="{{$provider->user->image}}" alt="" class="ui image" style="width:100%"/>
                        </div>
                        <div class="ui basic segment" style="padding: 24px;margin-top: 0;">
                            <p style="font-size: 24px; font-weight: bold;line-height: 30px;">
                                <span class="ui blue text">{{$provider->user->name}}</span>
                            </p>
                            <div style="font-size: 20px; line-height: 30px;padding-top:24px;">
                                <p>{{$provider->entity->name}}</p>
                                <p>{{$provider->user->sectors->first()->name}}</p>
                            </div>
                            <div style="text-align: center">
                                <a href="{{$provider->user->path}}" class="ui black link tiny button">KNOW MORE</a>
                                <a href="#" class="ui orange link tiny button">BOOK A SESSION</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.ui.dropdown').dropdown();
    </script>
@endsection
