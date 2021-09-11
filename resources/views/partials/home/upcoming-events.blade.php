<div class="ui inverted grey basic segment" style="margin: 0;">
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <p style="font-weight: 600;font-size: 16px;line-height: 0px;letter-spacing: 0.105em;"><span
                class="ui black text">JOIN THE COMMUNITY AND THE DEBATE</span></p>
        <h1 class="ui header" style="margin-top: 8px;font-size: 56px;"><span class="ui blue text">Upcoming Events</span></h1>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui stackable grid">
            @foreach($events as $event)
                <div class="ui four wide column">
                    <div class="ui raised padded segment" style="height: 303px; position: relative;">
                        <p style="font-weight: 600;font-size: 16px;line-height: 22px;text-transform: uppercase;">28 -30 September 2019</p>
                        <p style="font-weight: 600;font-size: 20px;line-height: 30px;">Alexandria, Egypt</p>.
                        <div class="ui hidden divider"></div>
                        <div class="ui blue header">Techne Summit</div>
                        <a href="#" style="position: absolute; bottom: 8%;font-weight: bold;letter-spacing: 0.105em; line-height: 22px">
                            <span class="ui primary text" style="border-bottom: 2px solid #153E7A">VIEW DETAILS</span> &nbsp;
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
