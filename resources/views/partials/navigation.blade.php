<style>@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap");</style>
<div class="ui container">
    <div class="ui secondary blue pointing menu" style="border:none;box-shadow: none;">
        <a href="/"><img class="ui image left item" src="{{asset('images/logo.png')}}" alt="" width="190px" style="margin-top: 20px;padding-left:0;"></a>
        <div class="right item">
            <a href="{{route('profile.index')}}" class="{{Request::path() === 'profile' ? 'active':''}} item">
                MEMBERS
            </a>
            <a href="{{route('entity.index')}}" class="{{Request::path() === 'entity' ? 'active':''}} item">
                ORGANIZATIONS
            </a>
            @auth('web')
                <div class="ui dropdown item" style="border-bottom: none!important;top:-7px;font-weight:normal;">
                    <div class="text">
                        @if(Auth::user()->avatar()->exists())
                            <img class="ui avatar image" src="{{Auth::user()->avatar()->thumbnail()->url}}">
                        @else
                            <i class="circular inverted grey user icon"></i>
                        @endif
                        {{Auth::user()->name}}
                    </div>
                    <i class="dropdown icon"></i>
                    <div class="menu" id="desktopMenu">
                        {{--                        <a href="#" class="item">--}}
                        {{--                            <i class="envelope blue icon"></i> Inbox--}}
                        {{--                        </a>--}}
                        <a href="{{route('profile.entities')}}" class="item">
                            <i class="university blue icon"></i> Organizations
                        </a>
                        <a href="{{route('profile.edit',['profile'=>Auth::user()])}}" class="item">
                            <i class="cog blue icon"></i> Profile Settings
                        </a>
                        <div class="ui blue inverted item" style="background: none !important;">
                            <form method="post" action="{{route('logout')}}">
                                @csrf
                                <button type="submit" class="ui teal fluid button">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
            @guest
                <a class="item">
                    <a href="{{ route('profile.create') }}" class="ui blue basic button">Signup</a>
                </a>
                <div class="item">
                    <a href="{{route('home')}}" class="ui blue button">Login</a>
                </div>
            @endguest
        </div>
    </div>
</div>
<br><br>

