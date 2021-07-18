<div class="ui fixed inverted menu" style="border:none;box-shadow: none;">
    <div class="ui container">
        <a href="/admin/" class="item">
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

        <div class="right item">
            <a href="{{route('admin.admins.edit', Auth::guard('admin')->user())}}">Edit Profile <i
                    class="pencil icon"></i></a>&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0)" onclick="$('#admin_logout').submit();">Logout <i class="logout icon"></i></a>
        </div>
    </div>
</div>
<form method="post" action="{{route('admin.logout')}}" id="admin_logout">
    @csrf
</form>
<br><br><br><br>

