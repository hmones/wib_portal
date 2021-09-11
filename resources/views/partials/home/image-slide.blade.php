<div class="ui container grid" style="height: 665px;position: relative;">
    <div class="ui grey inverted basic segment"
         style="position:absolute; top:17.14%;bottom: 6.32%;width: 100%;height: 509px;border-radius: 6px;">
        <div class="ui basic segment" style="width: 40%;left: 20px;">
            <p style="font-weight: bold;font-size: 18px;">NEXT EVENT</p>
            <h1 class="ui blue header"
                style="margin-top:10px;font-size: 80px;line-height: 86px;display: inline-flex;">{{$event->title}}</h1>
            <p style="font-weight: 600;font-size: 28px;line-height: 36px;">{{$event->description}}</p>
            <a href="{{$event->link}}"
               style="margin-top: 32px;font-weight: 600;padding: 15px 25px 15px 25px;font-size: 16px;"
               class="ui orange big button"><span class="ui blue text">{{$event->button_text}}</span></a>
        </div>
    </div>
    <div
        style="position: absolute; z-index: 1; left: 52.86%; right:8.04%;height: 665px;border-radius: 6px;background: linear-gradient(180deg, rgba(0, 0, 0, 0) 61.95%, rgba(0, 0, 0, 0.8) 100%), url('{{$event->image}}');">
        <div style="position:relative;height: 100%">
            <div style="position:absolute;bottom:5%;left:5%;color: white;">
                <p style="font-weight: 600;font-size: 28px;line-height: 36px;"><i class="clock outline icon"></i> {{$event->from->format('d')}} - {{$event->to->format('d F Y')}}</p>
                <p style="font-weight: 600;font-size: 28px;line-height: 36px;"><i class="map pin icon"></i> {{$event->location}}</p>
            </div>
        </div>
    </div>
    <img src="{{asset('images/shapes/diamond.svg')}}" alt="diamond"
         style="position: absolute; left: 33.55%;top: 8.57%;">
    <img src="{{asset('images/shapes/rectangle.svg')}}" alt="rectangle"
         style="position: absolute; left: 25.31%;top: 90.08%;">
    <img src="{{asset('images/shapes/diamond-outline.svg')}}" alt="diamond-outline"
         style="position: absolute; left: -3%;right:99%;top: 40%;">
    <img src="{{asset('images/shapes/hexagon-outline.svg')}}" alt="hexagon-outline"
         style="position: absolute; left: 46.37%;top: 30.23%;">
    <img src="{{asset('images/shapes/square.svg')}}" alt="square" style="position: absolute; left: 96.65%;top: 56.09%;">
</div>
