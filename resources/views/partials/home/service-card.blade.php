<div class="ui card raised segment">
    <div class="ui right floated basic segment"><i
            class="big {{$icon}} icon"></i></div>
    <div class="ui basic segment">
        <div class="ui hidden divider"></div>
        <div class="ui blue flex card header">{{$title}}</div>
        <p>{{$content}}</p>
    </div>
    @if($link)
        @include('partials.components.link', ['link' => $link, 'text' => 'EXPLORE'])
    @endif
</div>
