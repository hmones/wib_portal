<form class="ui form" method="POST" action="{{$url == 'user'? route('login'):route('admin.')}}">
    @csrf
    <div class="ui blue header">Login</div>
    <div class="ui divider"></div>
    <div class="@error('email') error @enderror field">
        <input
                class="form-control"
                id="email"
                name="email"
                placeholder="Email"
                value="{{old('email')}}"
                required
                autocomplete="email"
                autofocus
                type="email"/>
    </div>

    <div class="@error('password') error @enderror field">
        <input
                id="password"
                class="form-control"
                name="password"
                placeholder="Password"
                required
                autocomplete="current-password"
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
