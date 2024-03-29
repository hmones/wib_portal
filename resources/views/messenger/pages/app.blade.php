@extends('layouts.messenger')
@section('title','Messenger')
@section('content')
<div class="ui container" style="min-height:80vh;">
    <div class="messenger" style="min-height:80vh;">
        {{-- ----------------------Users/Groups lists side---------------------- --}}
        <div class="messenger-listView" style="border:none !important;">
            {{-- Header and search bar --}}
            <div class="m-header ui form">
                <nav>
                    <a href="#"><i class="inbox blue icon"></i> <span
                            class="ui blue header messenger-headTitle">Inbox</span> </a>
                    <br />
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        {{-- <a href="#"><i class="fas fa-cog settings-btn"></i></a> --}}
                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                    </nav>
                </nav>
                {{-- Search input --}}
                <div class="ui icon input" style="margin-top:10px;margin-left:38px;">
                    <input type="text" class="messenger-search" placeholder="Search for a member" />
                    <i class="search icon"></i>
                </div>

            </div>
            {{-- tabs and lists --}}
            <div class="m-body">
                {{-- Lists [Users/Group] --}}
                {{-- ---------------- [ User Tab ] ---------------- --}}
                <div class="@if($route == 'user') show @endif messenger-tab app-scroll" data-view="users">

                    {{-- Favorites --}}
                    <p class="messenger-title">Favorites</p>
                    <div class="messenger-favorites app-scroll-thin"></div>

                    {{-- Saved Messages --}}
                    {!! view('messenger.layouts.listItem', ['get' => 'saved','id' => $id])->render() !!}

                    {{-- Contact --}}
                    <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);"></div>

                </div>


                {{-- ---------------- [ Search Tab ] ---------------- --}}
                <div class="messenger-tab app-scroll" data-view="search">
                    {{-- items --}}
                    <p class="messenger-title">Search</p>
                    <div class="search-records">
                        <p class="message-hint"><span>Type to search..</span></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ----------------------Messaging side---------------------- --}}
        <div class="messenger-messagingView" style="border:none;">
            {{-- header title [conversation name] amd buttons --}}
            <div class="m-header m-header-messaging">
                <nav>
                    {{-- header back button, avatar and user name --}}
                    <div style="display: inline-flex;">
                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                        <div class="avatar av-s header-avatar"
                            style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                        </div>
                        <a href="#" class="user-name">{{ config('messenger.name') }}</a>
                    </div>
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                        {{-- <a href="{{ route('home') }}"><i class="fas fa-home"></i></a> --}}
                        <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                    </nav>
                </nav>
            </div>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
            {{-- Messaging area --}}
            <div class="m-body app-scroll">
                <div class="messages">
                    <p class="message-hint" style="margin-top: calc(30% - 126.2px);"><span>Please select a chat to start
                            messaging</span></p>
                </div>
                {{-- Typing indicator --}}
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <p>
                            <span class="typing-dots">
                                <span class="dot dot-1"></span>
                                <span class="dot dot-2"></span>
                                <span class="dot dot-3"></span>
                            </span>
                        </p>
                    </div>
                </div>
                {{-- Send Message Form --}}
                @include('messenger.layouts.sendForm')
            </div>
        </div>
        {{-- ---------------------- Info side ---------------------- --}}
        <div class="messenger-infoView app-scroll">
            {{-- nav actions --}}
            <nav>
                <a href="#"><i class="fas fa-times"></i></a>
            </nav>
            {!! view('messenger.layouts.info')->render() !!}
        </div>
    </div>
</div>

@include('messenger.layouts.modals')
@include('messenger.layouts.footerLinks')
@endsection
