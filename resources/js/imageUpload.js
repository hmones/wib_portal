$(document).on('click', '#image_upload_icon', function () {
    $('#image_upload_input').trigger('click');
});

$(document).on('change', '#image_upload_input', function () {
    var file = $(this)[0].files[0];
    if (file != null && file.size < 2000000) {
        var reader = new FileReader();
        reader.onload = function () {
            $('#image_upload_icon i').remove();
            $('#image_upload_icon').css('background-image', 'url("' + reader.result + '")');
        }
        reader.readAsDataURL(file);
    } else {
        display_flash_msg('#image_flash_message', 'error', 'Error uploading the image, images should be png or jpg and less than 2MB');
        $('#image_upload_icon').html('<i></i>').addClass(shape).addClass('red info huge icon');
        $('div.image.description small').css('color', 'red');
    }
});
