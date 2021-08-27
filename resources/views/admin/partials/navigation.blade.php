<div class="ui fixed inverted borderless menu" style="border:none;box-shadow: none;">
    <div class="ui container">
        <div class="ui image item">
            <img class="ui image" src="{{asset('images/logo.png')}}" style="filter:invert(0.85);" width="70px"
                 alt="Women in Business Logo">
        </div>
        <a href="{{route('admin.home')}}" class="item">
            <i class="home icon"></i> Dashboard
        </a>
        <a href="{{route('admin.users')}}" class="{{request()->path() === 'admin/users' ? 'active':''}} item">
            <i class="users icon"></i> Users
        </a>
        <a href="{{route('admin.entities')}}" class="{{request()->path() === 'admin/entities' ? 'active':''}} item">
            <i class="building icon"></i> Entities
        </a>

        <a href="{{route('admin.options')}}" class="{{request()->path() === 'admin/options' ? 'active':''}} item">
            <i class="cog icon"></i> Options
        </a>

        <a href="{{route('admin.admins.index')}}" class="{{request()->path() === 'admin/admins' ? 'active':''}} item">
            <i class="user circle icon"></i> Admins
        </a>

        <div class="ui right inverted menu">
            <a href="{{route('admin.admins.edit', auth()->guard('admin')->user())}}"
               class="{{request()->url() === route('admin.admins.edit', Auth::guard('admin')->user()) ? 'active' : ''}} item">
                <i class="pencil icon"></i> Edit Profile
            </a>&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0)" onclick="$('#admin_logout').submit();" class="item">
                <i class="logout icon"></i> Logout
            </a>
        </div>
    </div>
</div>
<form method="post" action="{{route('admin.logout')}}" id="admin_logout">
    @csrf
</form>
<br><br><br><br>

