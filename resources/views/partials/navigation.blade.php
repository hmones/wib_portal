<div class="ui grid">
    <div class="column computer only row">
        <div class="ui container">
            <div class="ui secondary borderless blue pointing menu" id="topMainDesktopMenu">
                <a href="/"><img class="ui image left item" src="{{asset('images/logo.png')}}" alt="" width="190px"></a>
                <div class="right item">
                    @auth('web')
                        @include('partials.search')
                        <a href="{{route('home')}}" class="item mainMenu"> HOME </a>
                        <a href="{{route('post.index')}}" class="item mainMenu"> POSTS </a>
                        <div class="ui dropdown account item mainMenu">
                            NETWORK <i class="angle down black icon"></i>
                            <div class="menu network">
                                <a href="{{route('profile.index')}}" class="item">
                                    <i class="users blue icon"></i> People
                                </a>
                                <a href="{{route('entity.index')}}?type=business" class="item">
                                    <i class="handshake blue icon"></i> Companies
                                </a>
                                <a href="{{route('entity.index')}}?type=organization" class="item">
                                    <i class="university blue icon"></i> Organizations
                                </a>

                            </div>
                        </div>
                        <div class="ui dropdown account item">
                            @include('partials.components.avatar', [
                            'user'=>auth()->user(),
                            'type'=>'user',
                            'classes' => 'big avatar'
                            ])
                            <i class="dropdown icon"></i>
                            <div class="menu" id="desktopMenu">
                                <a href="{{route('messenger')}}" class="item">
                                    <i class="blue envelope icon"></i> Messages
                                    @if(auth()->user()->unreadNotifications()->where('type','App\Notifications\MessageSent')->count())
                                        <div class="floating ui red label">
                                            {{auth()->user()->unreadNotifications()->where('type','App\Notifications\MessageSent')->count()}}
                                        </div>
                                    @endif
                                </a>
                                <a href="{{route('notifications')}}" class="item">
                                    <i class="blue bell icon"></i> Notifications
                                    @if(auth()->user()->unreadNotifications()->where('type','!=','App\Notifications\MessageSent')->count())
                                        <div class="floating ui red label">
                                            {{auth()->user()->unreadNotifications()->where('type','!=','App\Notifications\MessageSent')->count()}}
                                        </div>
                                    @endif
                                </a>
                                <a href="{{route('profile.entities')}}" class="item">
                                    <i class="university blue icon"></i> My Business
                                </a>
                                <a href="{{auth()->user()->path . '/edit'}}" class="item">
                                    <i class="user blue icon"></i> Account
                                </a>
                                <div class="ui blue inverted item" style="background: none !important;">
                                    @auth('admin')
                                        <form method="get" action="{{route('admin.impersonate.index')}}">
                                            @csrf
                                            <button type="submit" class="ui teal fluid button">Logout
                                            </button>
                                        </form>
                                    @else
                                        <form method="post" action="{{route('logout')}}">
                                            @csrf
                                            <button type="submit" class="ui teal fluid button">Logout
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endauth
                    @guest
                        <a class="item">
                            <a href="{{ route('profile.create') }}" class="ui blue basic button">Signup</a>
                        </a>
                        <div class="item">
                            <a href="{{route('login')}}" class="ui blue button">Login</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="column mobile tablet only row">
        <div class="ui four column grid" id="topMainTabletMenu">
            <div class="center aligned eight wide column">
                <a href="/"><img class="ui image left item" src="{{asset('images/logo.png')}}" alt="" width="150px"></a>
            </div>
            @auth('web')
                <div class="right aligned three wide column">
                    <button onclick="$('#mobileMenu').toggle('fade');" class="ui grey button">
                        <i class="bars black icon"></i>
                    </button>
                </div>
            @endauth
            @guest
                <div class="right aligned three wide column" style="margin-top: 22px;">
                    <a href="{{route('login')}}"><i class="circular inverted teal lock icon"></i></a>
                    <a href="{{route('profile.create')}}"><i class="circular inverted teal user icon"></i></a>
                </div>
            @endguest
        </div>
    </div>
</div>
@auth('web')
    <div class="ui grid">
        <div class="center aligned column mobile tablet only" id="mobileMenu" style="display: none;">
            <div class="ui center aligned basic segment">
                @include('partials.search')
            </div>
            <div class="ui divided very relaxed list">
                <a class="item" href="{{route('post.index')}}">Posts</a>
                <a href="{{route('messenger')}}" class="item">
                    Messages
                    @if(auth()->user()->unreadNotifications()->where('type','App\Notifications\MessageSent')->count())
                        <div class="floating ui red label">
                            {{auth()->user()->unreadNotifications()->where('type','App\Notifications\MessageSent')->count()}}
                        </div>
                    @endif
                </a>
                <a href="{{route('notifications')}}" class="item">
                    Notifications
                    @if(auth()->user()->unreadNotifications()->where('type','!=','App\Notifications\MessageSent')->count())
                        <div class="floating ui red label">
                            {{auth()->user()->unreadNotifications()->where('type','!=','App\Notifications\MessageSent')->count()}}
                        </div>
                    @endif
                </a>
                <a href="{{route('profile.index')}}" class="item"> People </a>
                <a href="{{route('entity.index')}}?type=business" class="item"> Companies </a>
                <a href="{{route('entity.index')}}?type=organization" class="item"> Organizations </a>
                <a href="{{auth()->user()->path . '/edit'}}" class="item">Account</a>
                <a href="{{route('profile.entities')}}" class="item">My Business</a>
                <br>
                @auth('admin')
                    <form method="get" action="{{route('admin.impersonate.index')}}">
                        @csrf
                        <button type="submit" class="ui teal fluid button">Logout</button>
                    </form>
                @else
                    <form method="post" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="ui teal fluid button">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endauth
<br><br>
