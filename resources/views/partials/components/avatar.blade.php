<img class="ui avatar {{isset($classes)?$classes:''}} image" src="

@if($type == 'user')

@if(optional($user)->image)
{{$user->image}}
@else
@if (optional($user)->gender === 'Female')
{{asset('images/female_avatar.jpg')}}
@else
{{asset('images/male_avatar.jpg')}}
@endif
@endif

@elseif($type == 'entity')

@if($entity->image)
{{$entity->image}}
@else
{{asset('images/logo_avatar.png')}}
@endif

@endif

    " style="{{isset($styles)?$styles:''}}"/>
