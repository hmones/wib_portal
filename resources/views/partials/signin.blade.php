<form class="ui form" method="POST" action="{{$url == 'user'? '/login':route('admin.')}}">
    @csrf
    <div class="ui blue header">Login</div>
    <div class="ui divider"></div>
    <div class="field">
        <input
            class="form-control"
            name="email"
            placeholder="Email"
            type="email"/>
    </div>

    <div class="field">
        <input
            class="form-control"
            name="password"
            placeholder="Password"
            type="password"/>
    </div>
    <a href="{{route('password.request')}}">Forgot password?</a>
    <br><br>
    <button class="ui primary fluid button" type="submit">Login</button>
    <div class="ui divider"></div>
    @if($url==='user')
        <a href="{{route('profile.create')}}" class="ui primary fluid basic button">Signup</a>
    @endif

</form>
