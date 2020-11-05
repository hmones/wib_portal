@if($type == 'user')

@if($user->image)
<img class="ui avatar image" src="{{$user->image}}">
@else
@if ($user->gender === 'Female')
<img class="ui avatar image" src="{{asset('images/female_avatar.jpg')}}">
@else
<img class="ui avatar image" src="{{asset('images/male_avatar.jpg')}}">
@endif
@endif

@elseif($type == 'entity')

@if($entity->image)
<img class="ui avatar image" src="{{$entity->image}}">
@else
<img class="ui avatar image" src="{{asset('images/logo_avatar.png')}}">
@endif

@endif