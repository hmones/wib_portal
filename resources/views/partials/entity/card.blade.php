<div class="column">
    <a href="{{route('entity.show',$entity)}}" class="profilebox">
        <img class="profileimage" src="
    @if($entity->logo()->exists())
        {{$entity->logo()->thumbnail()->url}}
        @else
        {{asset('images/logo_avatar.png')}}
        @endif
            " alt="{{$entity->name}}'s avatar">

        <div class="profilecontent">
            <p>{{strtoupper($entity->sectors()->first()->name)}}</p>
            <h2>{{\Illuminate\Support\Str::limit($entity->name, 14,$end='..')}}</h2>
            <b>{{strtoupper($entity->primary_country->name)}}</b>
        </div>
    </a>
</div>

