
<div class="ui container">
    <div class="ui secondary pointing menu" style="border:none;box-shadow: none;">
        <a href="/"><img class="ui image left item" src="{{asset('images/logo.png')}}" alt="" width="190px" style="margin-top: 20px;padding-left:0;"></a>
        <div class="right item">
            <a href="/" class="{{Request::path() === '/' ? 'active':''}} item">
                Home
            </a>
            <a href="/profile" class="{{Request::path() === 'profile' ? 'active':''}} item">
                Members
            </a>
            <a class="item">
                <a href="/profile/create" class="ui green button">Signup</a>
            </a>
            <div class="item">
                <a href="#" class="ui blue button">Login</a>
            </div>
        </div>
    </div>
</div>
<br><br>

