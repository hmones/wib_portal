@component('mail::message')
<h1>Hi, {{$message->receiver->name}}</h1>
<br>
{{$message->sender->name}} sent you a message over the platform
<br>
@component('mail::button', ['url' => $path])
View Message
@endcomponent

Thanks,<br>
{{ config('app.name') }}
<br><br>
<hr style="border-color:white;">
<small>If you would like to stop receiving similar notifications <a
        href="{{url('/')}}/profile/{{$message->receiver->id}}/edit">click here</a></small>
@endcomponent