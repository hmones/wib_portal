<div class="ui imageSlide computer only container grid">
    <div class="ui grey inverted basic segment">
        <div class="ui content basic segment">
            <p class="byline">NEXT EVENT</p>
            <h1 class="ui blue header">{{$event->title}}</h1>
            <p class="description">{{$event->description}}</p>
            <a href="{{$event->link}}" class="ui link orange big button">
                <span class="ui blue text">{{$event->button_text}}</span>
            </a>
        </div>
    </div>
    <div class="event details"
         style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 61.95%, rgba(0, 0, 0, 0.8) 100%), url('{{$event->image}}');">
        <div class="wrapper">
            <div class="bottom content">
                <p>
                    <i class="clock outline icon"></i> {{$event->from->format('d')}} - {{$event->to->format('d F Y')}}
                </p>
                <p>
                    <i class="map pin icon"></i> {{$event->location}}
                </p>
            </div>
        </div>
    </div>
    <img class="diamond shape" src="{{asset('images/shapes/diamond.svg')}}" alt="diamond">
    <img class="rectangle shape" src="{{asset('images/shapes/rectangle.svg')}}" alt="rectangle">
    <img class="diamond outline shape" src="{{asset('images/shapes/diamond-outline.svg')}}" alt="diamond-outline">
    <img class="hexagon outline shape" src="{{asset('images/shapes/hexagon-outline.svg')}}" alt="hexagon-outline">
    <img class="square shape" src="{{asset('images/shapes/square.svg')}}" alt="square">
</div>

<div class="ui imageSlide mobile only tablet only container grid">
    <div class="twelve wide centered center aligned column">
        <div class="ui center aligned basic segment">
            <p class="byline">NEXT EVENT</p>
            <h1 class="ui blue header">{{$event->title}}</h1>
        </div>
        <div class="event details"
             style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 61.95%, rgba(0, 0, 0, 0.8) 100%), url('{{$event->image}}');">
            <div class="wrapper">
                <div class="bottom content">
                    <p>
                        <i class="clock outline icon"></i> {{$event->from->format('d')}} - {{$event->to->format('d M Y')}}
                    </p>
                    <p>
                        <i class="map pin icon"></i> {{$event->location}}
                    </p>
                </div>
            </div>
        </div>
        <p class="description">{{$event->description}}</p>
        <a href="{{$event->link}}" class="ui link orange big button">
            <span class="ui blue text">{{$event->button_text}}</span>
        </a>
        <br><br>
        <img class="diamond shape" src="{{asset('images/shapes/diamond.svg')}}" alt="diamond">
        <img class="rectangle shape" src="{{asset('images/shapes/rectangle.svg')}}" alt="rectangle">
        <img class="hexagon outline shape" src="{{asset('images/shapes/hexagon-outline.svg')}}" alt="hexagon-outline">
        <img class="square shape" src="{{asset('images/shapes/square-outline.svg')}}" alt="square">
    </div>
</div>
