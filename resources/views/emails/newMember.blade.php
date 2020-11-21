@component('mail::message')
<h1>Hi, {{$notifiable->name}}</h1>
<br>

A new member has registered to the platform with the name {{$user->name}} in your field of work

@component('mail::button', ['url' => url('/') . '/profile/' . $user->id ])
Visit User Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
<br><br>
<hr style="border-color:white;">
<small>If you would like to stop receiving similar notifications <a
        href="{{url('/')}}/profile/{{$notifiable->id}}/edit">click here</a></small>
@endcomponent