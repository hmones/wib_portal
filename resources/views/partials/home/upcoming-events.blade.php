<div class="ui section inverted grey basic segment">
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <p class="byline normal"><span class="ui black text">JOIN THE COMMUNITY AND THE DEBATE</span></p>
        <h1 class="ui page header"><span class="ui blue text">Upcoming Events</span></h1>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui stackable grid">
            @foreach($events as $event)
                <div class="ui four wide column">
                    <div class="ui card raised padded segment">
                        <p class="date">28 -30 September 2019</p>
                        <p class="location">Alexandria, Egypt</p>.
                        <div class="ui hidden divider"></div>
                        <div class="ui blue card header">
                            Techne Summit
                        </div>
                        <a href="#">
                            <span class="ui primary text">VIEW DETAILS</span>
                            &nbsp;
                            <img src="{{asset('images/shapes/arrow.svg')}}" height="11px" alt="arrow-event">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
    </div>
</div>
