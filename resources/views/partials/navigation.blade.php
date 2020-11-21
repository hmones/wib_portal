<div class="ui grid">
    <div class="column computer only row">
        <div class="ui container">
            <div class="ui secondary blue pointing menu" style="border:none;box-shadow: none;">
                <a href="/"><img class="ui image left item" src="{{asset('images/logo.png')}}" alt="" width="190px"
                        style="margin-top: 20px;padding-left:0;"></a>
                <div class="right item">
                    @auth('web')
                    @include('partials.search')
                    <a href="{{route('profile.index')}}" class="{{Request::path() === 'profile' ? 'active':''}} item">
                        MEMBERS
                    </a>
                    <a href="{{route('entity.index')}}" class="{{Request::path() === 'entity' ? 'active':''}} item">
                        ORGANIZATIONS
                    </a>
                    <a href="#">
                        <i class="icons">
                            <i class="circular inverted blue bell icon"></i>
                            @if(Auth::user()->unreadNotifications()->where('type','!=','App\Notifications\MessageSent')->count())
                            <i class="top right corner inverted circular red big menuNotification icon">
                                <span>
                                    {{Auth::user()->unreadNotifications()->where('type','!=','App\Notifications\MessageSent')->count()}}
                                </span>
                            </i>
                            @endif
                        </i>
                    </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{route('messenger')}}">
                        <i class="icons">
                            <i class="circular inverted blue envelope icon"></i>
                            @if(Auth::user()->unreadNotifications()->where('type','App\Notifications\MessageSent')->count())
                            <i class="top right corner inverted circular red big menuNotification icon">
                                <span>
                                    {{Auth::user()->unreadNotifications()->where('type','App\Notifications\MessageSent')->count()}}
                                </span>
                            </i>
                            @endif
                        </i>
                    </a>
                    <div class="ui dropdown account item">

                        @include('partials.components.avatar', [
                        'user'=>Auth::user(),
                        'type'=>'user',
                        'classes' => 'big',
                        'styles' => 'margin-right:0px;width:37px;'
                        ])

                        <i class="dropdown icon"></i>
                        <div class="menu" id="desktopMenu">
                            <a href="{{route('profile.edit',['profile'=>Auth::user()])}}" class="item">
                                <i class="user blue icon"></i> My Account
                            </a>
                            <a href="{{route('profile.entities')}}" class="item">
                                <i class="university blue icon"></i> My Organizations
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
    </div>
    <div class="column mobile tablet only grey row">
        <div class="ui four column grid">
            <div class="center aligned eight wide column">
                <a href="/"><img class="ui image left item" src="{{asset('images/logo.png')}}" alt="" width="190px"
                        style="
                margin-top: 8px;padding-left:20px;filter:contrast(0.899);"></a>
            </div>
            @auth('web')
            <div class="right aligned seven wide column">
                <button onclick="$('#mobileMenu').toggle('fade');" class="ui grey button"
                    style="margin-top: 20px;margin-right: -30px;padding: 10px 5px 10px 15px;"><i
                        class="bars black icon"></i></button>
            </div>
            @endauth
        </div>
    </div>
</div>
@auth('web')
<div class="ui grid">
    <div class="column mobile tablet only row" id="mobileMenu" style="display: none;">
        <div class="ui four column centered grid">
            <div class="center aligned sixteen wide column">
                <div class="ui divided very relaxed list">

                    <div class="item"><a href="/profile">MEMBERS</a> </div>
                    <div class="item"><a href="/entity">ORGANIZATIONS</a></div>

                    <div class="item"><a href="{{route('profile.edit',['profile'=>Auth::user()])}}">Profile Settings</a>
                    </div>
                    <div class="item"><a href="{{route('profile.entities')}}">Register Organization</a></div>
                    <br>
                    <div class="ui blue inverted " style="background: none !important;">
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="ui teal fluid button">Logout</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endauth
<br><br>