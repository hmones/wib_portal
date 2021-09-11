<div class="ui raised segment" style="height: 303px; position: relative;">
    <div class="ui right floated basic segment" style="padding-right:0;margin-right: 0;"><i class="big {{$icon}} icon"></i></div>
    <div class="ui basic segment">
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui blue header" style="display: inline-flex;margin-top:0">{{$title}}</div>
        <p>{{$content}}</p>
    </div>
    <a href="{{$link}}" style="position: absolute; bottom: 8%;font-weight: bold;letter-spacing: 0.105em; line-height: 22px;left:7%">
        <span class="ui primary text" style="border-bottom: 2px solid #153E7A">EXPLORE </span> &nbsp;
        <img src="{{asset('images/shapes/arrow.svg')}}" height="11px" alt="arrow-event">
    </a>
</div>
