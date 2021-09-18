function toggleTestimonial(current, prev, next) {
    $('#testimonial_' + prev).hide();
    $('#testimonial_' + next).hide();
    $('#testimonial_' + current).fadeIn();
    $('#testimonial_img_' + prev).removeClass('active');
    $('#testimonial_img_' + next).removeClass('active');
    $('#testimonial_img_' + current).addClass('active');
}
