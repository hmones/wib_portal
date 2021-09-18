<div class="ui padded raised segment testimonial card" id="testimonial_{{$testimonialId}}"
     style="{{$testimonialActive ? '' : 'display:none;'}}">
    <div class="ui grid">
        <div class="ui left floated basic segment">
            <img src="{{asset('images/shapes/quote.svg')}}" alt="">
        </div>
    </div>
    <div class="ui mobile reversed tablet reversed stackable grid">
        <div class="nine wide content column">
            <div class="ui blue header"
                 style="">
                {{$testimonialContent}}
            </div>
            <div class="ui black header">
                {{$testimonialName}}
            </div>
            <span>{{$testimonialPosition}}</span>
            <div class="ui hidden divider"></div>
        </div>
        <div class="three wide column">
            <img class="ui testimonial image" src="{{asset('images/testimonials/'.$testimonialId.'.png')}}"
                 alt="testimonial{{$testimonialId}}"/>
        </div>
    </div>
</div>
