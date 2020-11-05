<div class="column">
    <a href="{{route('profile.show', $user->id)}}" class="profilebox">
        <img class="profileimage" src="
            @if($user->image)
                {{$user->image}}
            @else
                @if($user->gender === 'Male')
                {{asset('images/male_avatar.jpg')}}
                @else
                {{asset('images/female_avatar.jpg')}}
                @endif
            @endif
            " alt="{{$user->name}}'s avatar">
        @if($user->approved_at)
        <i class="circular inverted teal check small icon" style="
                position: absolute;
                z-index: 3;
                top: 25px;
                right: 25px;"></i>
        @endif
        <div class="profilecontent">
            @isset($user->sectors->first()->name)
            <p>{{strtoupper($user->sectors->first()->name)}}</p>
            @endisset
            <h2>{{\Illuminate\Support\Str::limit($user->name, 14,$end='..')}}</h2>
            @isset($user->country->name)
            <b>{{strtoupper($user->country->name)}}</b>
            @endisset
        </div>
    </a>
</div>