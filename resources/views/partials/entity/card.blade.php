<div class="column">
    <a href="{{route('entity.show',$entity)}}" class="profilebox">
        <img class="profileimage" src="
            @isset($entity->logo->first()->url)
            {{$entity->logo->first()->url}}
            @else
            {{asset('images/logo_avatar.png')}}
            @endif
            " alt="{{$entity->name}}'s avatar">

        <div class="profilecontent">
            @isset($entity->sectors->first()->name)
                <p>{{strtoupper($entity->sectors->first()->name)}}</p>
            @endisset
            <h2>{{\Illuminate\Support\Str::limit($entity->name, 14,$end='..')}}</h2>
            @isset($entity->primary_country->name)
                <b>{{strtoupper($entity->primary_country->name)}}</b>
            @endisset
        </div>
    </a>
</div>

