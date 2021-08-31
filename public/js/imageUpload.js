$(document).on('click', '#image_upload_icon', function () {
    $('#image_upload_input').trigger('click');
});

$(document).on('change', '#image_upload_input', function () {
    var file = $(this)[0].files[0];
    if (file != null && file.size < 2000000) {
        var image_html = "<img src='' alt=''/>";
        var reader = new FileReader();
        reader.onload = function () {
            var html = $(image_html).attr('src', reader.result).css('width', width).css('height', height).addClass('ui').addClass(shape).addClass('centered small image');
            $('#image_upload_icon').html(html);
            $('div.image.description small').css('color', 'black');
        }
        reader.readAsDataURL(file);
    } else {
        display_flash_msg('#image_flash_message', 'error', 'Error uploading the image, images should be png or jpg and less than 2MB');
        $('#image_upload_icon').html('<i></i>').addClass(shape).addClass('red info huge icon');
        $('div.image.description small').css('color', 'red');
    }
});
