@isset ($user)
@if($user->avatar()->exists())
<img class="ui avatar image" src="{{$user->avatar()->thumbnail()->url}}">
@else
@if ($user->gender === 'Female')
<img class="ui avatar image" src="{{asset('images/female_avatar.jpg')}}">
@else
<img class="ui avatar image" src="{{asset('images/male_avatar.jpg')}}">
@endif
@endif
@endisset

@isset ($entity)
@if($entity->logo()->exists())
<img class="ui avatar image" src="{{$entity->logo()->thumbnail()->url}}">
@else
<img class="ui avatar image" src="{{asset('images/logo_avatar.png')}}">
@endif
@endisset