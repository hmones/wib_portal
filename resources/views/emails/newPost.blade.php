@component('mail::message')
<h1>Hi, {{$notifiable->name}}</h1>
<br>
A new post was published in your field

@component('mail::button', ['url' => url('/') . '/home?id=' . $post->id])
Check it out
@endcomponent

Thanks,<br>
{{ config('app.name') }}
<br><br>
<hr style="border-color:white;">
<small>If you would like to stop receiving similar notifications <a
        href="{{url('/')}}/profile/{{$notifiable->id}}/edit">click here</a></small>
@endcomponent