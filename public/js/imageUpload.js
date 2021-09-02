$(document).on('click', '#image_upload_icon', function () {
    $('#image_upload_input').trigger('click');
});

$(document).on('change', '#image_upload_input', function () {

    var file = $(this)[0].files[0];
    if (file != null && file.size < 2000000) {
        var reader = new FileReader();
        reader.onload = function () {
            $('#image_upload_info').removeClass('basic red');
            $('#image_upload_icon i').remove();
            $('#image_upload_icon').css('background-image', 'url("' + reader.result + '")');
        }
        reader.readAsDataURL(file);
    } else {
        $('#image_upload_info').addClass('basic red');
        $('#image_upload_icon')
            .html('<i class="red exclamation triangle huge icon" style="margin-top: 50%;"></i>')
            .css('background-image', 'none');
        $('div.image.description small').css('color', 'red');
    }
});
