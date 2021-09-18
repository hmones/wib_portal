<link rel="stylesheet" href="{{asset('css/slider.css')}}"/>
<script src="{{asset('js/home.js')}}"></script>
<div class="ui container">
    @include('partials.home.testimonial-card', [
        'testimonialId' => 1,
        'testimonialActive' => true,
        'testimonialName' => 'Yusr Sabra',
        'testimonialContent' => 'I find the portal features very useful to get in contact with potential partners from the MENA Region. It is an innovative online tool to get access to new markets.',
        'testimonialPosition' => 'Co-founder and CEO, Wakilni'
    ])
    @include('partials.home.testimonial-card', [
        'testimonialId' => 2,
        'testimonialActive' => false,
        'testimonialName' => 'Dr. Yomna El Shereidy',
        'testimonialContent' => 'Connecting the portal with a B2B feature is a great digital instrument to expand the business of the WiB members.',
        'testimonialPosition' => 'CEO, Special Foods International Industry'
    ])
    @include('partials.home.testimonial-card', [
        'testimonialId' => 3,
        'testimonialActive' => false,
        'testimonialName' => 'Safia Akboudj',
        'testimonialContent' => 'Il est plaisant et intéressant pour les femmes cheffes d’entreprises dans notre région MENA d’avoir un outil numérique qui nous permet de promouvoir nos entreprises, découvrir le potentiel d’entreprises
de femmes dans notre région et pouvoir établir des connexions entre nous',
        'testimonialPosition' => 'Gérante, etb Akboudj'
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
