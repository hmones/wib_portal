<div class="column">
    <a href="{{$entity->path}}" class="profilebox">
        <img class="profileimage" src="
            @if($entity->image)
            {{$entity->image}}
            @else
            {{asset('images/logo_avatar.png')}}
            @endif
            " alt="{{$entity->name}}'s avatar">
        @if($entity->approved_at)
        <i class="circular inverted teal check small icon" style="
                position: absolute;
                z-index: 3;
                top: 25px;
                right: 25px;"></i>
        @endif
        <div class="profilecontent">
            @isset($entity->sectors->first()->name)
            <p>{{strtoupper($entity->sectors->first()->name)}}</p>
            @endisset
            <h2>{{Str::limit($entity->name, 14,$end='..')}}</h2>
            @isset($entity->primary_country->name)
            <b>{{strtoupper($entity->primary_country->name)}}</b>
            @endisset
        </div>
    </a>
</div>