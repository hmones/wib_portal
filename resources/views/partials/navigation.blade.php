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
                <div class="ui dropdown link item" style="border-bottom: none!important;">
                    <div class="text">
                        @if(Auth::user()->avatar()->exists())
                            <img class="ui avatar image" src="{{Auth::user()->avatar()->thumbnail()->url}}">
                        @else
                            <i class="circular inverted grey user icon"></i>
                        @endif
                            {{Auth::user()->name}}
                    </div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a href="{{route('profile.edit',['profile'=>Auth::user()])}}" class="item">
                            Profile
                        </a>
                        <a href="{{route('entity.show.user',['user'=>Auth::user()])}}" class="item">
                            Organizations
                        </a>
                        <a href="{{route('profile.settings',['profile'=>Auth::user()])}}"  class="item">
                            Account Settings
                        </a>
                        <div class="ui blue inverted item" style="background: none !important;">
                            <form method="post" action="{{route('logout')}}">
                                @csrf
                                <button type="submit" class="ui blue fluid basic button">Logout</button>
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

