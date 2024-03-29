<div class="ui section inverted grey basic segment">
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <p class="byline normal"><span class="ui black text">JOIN OUR EVENTS AND DEBATE</span></p>
        <h1 class="ui page header"><span class="ui blue text">Upcoming Events</span></h1>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui stackable grid">
            @foreach($events as $event)
                <div class="ui four wide column">
                    <div class="ui card raised padded segment">
                        <p class="date">
                            @if($event->from->isSameMonth($event->to))
                                {{$event->from->format('d')}} - {{$event->to->format('d F Y')}}
                            @else
                                {{$event->from->format('d M')}} - {{$event->to->format('d M Y')}}
                            @endif
                        </p>
                        <p class="location">{{$event->location}}</p>
                        <div class="ui hidden divider"></div>
                        <div class="ui blue card header">
                            {{$event->title}}
                        </div>
                        @isset($event->link)
                            @include('partials.components.link', ['link' => $event->link, 'text' => 'VIEW DETAILS'])
                        @endisset
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
    </div>
</div>
