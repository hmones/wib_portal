<link rel="stylesheet" href="{{asset('css/slider.css')}}"/>
<script src="{{asset('js/home.js')}}"></script>
<div class="ui container">
    @include('partials.home.testimonial-card', [
        'testimonialId' => 1,
        'testimonialActive' => true,
        'testimonialName' => 'Bassant Hemly',
        'testimonialContent' => 'WiB MENA is a network representing more than 2000 Businesswomen working in North Africa and the Middle East. ',
        'testimonialPosition' => 'CEO, Global Project Partners'
    ])
    @include('partials.home.testimonial-card', [
        'testimonialId' => 2,
        'testimonialActive' => false,
        'testimonialName' => 'Haytham Mones',
        'testimonialContent' => 'Women in Business MENA is a network representing more than 2000 Businesswomen working in North Africa and the Middle East. ',
        'testimonialPosition' => 'CEO, eSquare e.V.'
    ])
    @include('partials.home.testimonial-card', [
        'testimonialId' => 3,
        'testimonialActive' => false,
        'testimonialName' => 'Kadija Esseghiri',
        'testimonialContent' => 'That is MENA is a network representing more than 2000 Businesswomen working in North Africa and the Middle East. ',
        'testimonialPosition' => 'CFO, GPP e.V.'
    ])
    <div class="ui center aligned basic segment">
        <a href="javascript:void(0)" onclick="toggleTestimonial(1,3,2);" class="active slider button"
           id="testimonial_img_1">slider</a>
        <a href="javascript:void(0)" onclick="toggleTestimonial(2,1,3);" class="slider button" id="testimonial_img_2">
            slider
        </a>
        <a href="javascript:void(0)" onclick="toggleTestimonial(3,2,1);" class="slider button" id="testimonial_img_3">
            slider
        </a>
    </div>
</div>
