<div class="ui fixed inverted menu" style="border:none;box-shadow: none;">
    <div class="ui container">
        <a href="/admin/" class="item">
            <i class="home icon"></i> Dashboard
        </a>

        <a href="{{route('admin.users')}}" class="{{Request::path() === 'admin/users' ? 'active':''}} item">
            <i class="users icon"></i> Users
        </a>
        <a href="{{route('admin.entities')}}" class="{{Request::path() === 'admin/entities' ? 'active':''}} item">
            <i class="building icon"></i> Entities
        </a>

        <a href="{{route('admin.options')}}" class="{{Request::path() === 'admin/options' ? 'active':''}} item">
            <i class="cog icon"></i> Options
        </a>
        <div class="right item">
            Welcome, {{Auth::guard('admin')->user()->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="ui basic inverted tiny button" onclick="$('#admin_logout').submit();">Logout</button>
        </div>
    </div>
</div>
<form method="post" action="{{route('admin.logout')}}" id="admin_logout">
    @csrf
</form>
<br><br><br><br>

