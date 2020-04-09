<div class="column">
    <a href="{{route('profile.show', $user->id)}}" class="profilebox">
        <img class="profileimage" src="
    @if($user->avatar()->exists())
        {{$user->avatar()->thumbnail()->url}}
        @else
        @if($user->gender === 'Male')
        {{asset('images/male_avatar.jpg')}}
        @else
        {{asset('images/female_avatar.jpg')}}
        @endif
        @endif
            " alt="{{$user->name}}'s avatar">

        <div class="profilecontent">
            <p>{{strtoupper($user->sectors()->first()->name)}}</p>
            <h2>{{\Illuminate\Support\Str::limit($user->name, 14,$end='..')}}</h2>
            <b>{{strtoupper($user->country->name)}}</b>
        </div>
    </a>
</div>

