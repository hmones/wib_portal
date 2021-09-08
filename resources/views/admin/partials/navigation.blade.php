@include('partials.semantic-component', ['componentName' => 'sidebar'])
<div class="ui sidebar inverted vertical menu">
    <a class="ui header item" href="{{route('admin.home')}}" style="background-color:#262626;">
        <img class="ui image" src="{{asset('images/logo.png')}}" style="filter:invert(0.85);width:50%;"
             alt="Women in Business Logo"/>
    </a>
    <a href="{{route('admin.home')}}" class="item">
        <i class="home icon"></i> Dashboard
    </a>
    <div class="item">
        <div class="header">Users</div>
        <div class="menu">
            <a href="{{route('admin.users')}}" class="item">
                <i class="users icon"></i> Manage users
            </a>
            <a href="{{route('admin.admins.index')}}" class="item">
                <i class="user icon"></i> Manage admins
            </a>
        </div>

    </div>
    <div class="item">
        <div class="header">Entities</div>
        <div class="menu">
            <a href="{{route('admin.entities')}}" class="item">
                <i class="building icon"></i> Manage entities
            </a>
        </div>
    </div>
    <div class="item">
        <div class="header">Options</div>
        <div class="menu">
            <a href="{{route('admin.options')}}" class="item">
                <i class="cog icon"></i> Edit options
            </a>
        </div>
    </div>
    <div class="item">
        <div class="header">Events</div>
        <div class="menu">
            <a href="{{route('admin.events.create')}}"
               class="item">
                <i class="calendar plus icon"></i> Create event
            </a>
            <a href="{{route('admin.rounds.create')}}"
               class="item">
                <i class="calendar icon"></i>Create B2B rounds
            </a>
            <a href="{{route('admin.events.index')}}"
               class="item">
                <i class="calendar icon"></i> Manage events
            </a>
            <a href="{{route('admin.rounds.index')}}"
               class="item">
                <i class="calendar icon"></i>Manage B2B rounds
            </a>
        </div>
    </div>
    <div class="item">
        <div class="header">Account Settings</div>
        <div class="menu">
            <a href="{{route('admin.admins.edit', auth()->guard('admin')->user())}}"
               class="item">
                <i class="pencil icon"></i> Edit Profile
            </a>
            <a href="javascript:void(0)" onclick="$('#admin_logout').submit();" class="item">
                <i class="logout icon"></i> Logout
            </a>
        </div>
    </div>
    <form method="post" action="{{route('admin.logout')}}" id="admin_logout">
        @csrf
    </form>
</div>
