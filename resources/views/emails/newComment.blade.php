@component('mail::message')
<h2>Hi, {{$post->user->name}}</h2>
{{ $name }}, commented on your post
<br><br>
<i><strong>{{$post->content}}</strong></i>



@component('mail::button', ['url' => $path])
View comment
@endcomponent

<hr style="border-color:#e9e9e9;">
Thanks,<br>
{{ config('app.name') }}
@endcomponent