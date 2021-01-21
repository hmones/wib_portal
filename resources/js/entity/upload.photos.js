// function upload_images() {
//     $('#photoSelection').click();
// }

// $('#photoSelection').change(function () {
//     $('#styledUploader > div').html("<i class='notched circle loading big blue icon'></i><br><br>Upload in Progress");
//     $('#uploadPhotos').submit();
// });

$(document).on('click', '#uploadPhotoBtn', function () {
    $('#PhotosUploadInput').trigger('click');
});

$(document).on('click', 'i.close.icon.image', function () {
    var photo = $(this);
    var full_url = photos_store_url + '/' + photo.attr('data-id');
    photo.closest('.segment').addClass('loading');
    //Ajax call to remove the file
    $.ajax({
        method: 'POST',
        url: full_url,
        data: {
            _method: 'DELETE',
            _token: app_token,
        },
        error: function () {
            display_flash_msg(msg = 'Error deleting the image');
        }
    }).done(function (message) {
        photo.closest('.column').fadeOut(300, function () { $(this).remove(); });
    });
});

$(document).on('change', '#PhotosUploadInput', function () {
    let files = $('#PhotosUploadInput')[0].files;
    if (files != null) {
        let form = new FormData();
        for (var counter = 0; counter < files.length; counter++) {
            form.append("photos[]", files[counter]);
        }
        form.append('_token', app_token);
        $('#photosUploadIcon').removeClass('upload cloud').addClass('spinner loading');
        $.ajax({
            method: 'POST',
            url: photos_store_url,
            contentType: false,
            processData: false,
            data: form,
            error: function () {
                display_flash_msg(msg = 'Error uploading the image, images should be png or jpg and less than 2MB');
                $('#photosUploadIcon').removeClass('spinner loading').addClass('upload cloud');
            }
        }).done(function (link) {
            link.forEach(image => {
                var html = "<div class='column'><div class='ui center aligned segment'><div class='ui image'><img src='" + image.thumbnail + "'/></div></br></br><input type='text' placeholder='Add a comment ...' class='field photo comment' data-id='" + image.id + "'/><div class='floating ui red circular label'><i class='close icon image' data-id='" + image.id + "' style='margin-left:0px;'></i></div></div><input type='hidden' name='photosID[]' value='" + image.id + "'></div>";
                $(html).hide().appendTo('#photosContainer').fadeIn(1000);
            });
            $('#photosUploadIcon').removeClass('spinner loading').addClass('upload cloud');
        });
    }
});

$(document).on('change', 'input.field.photo.comment', function () {
    var comment = $(this);
    var full_url = photos_store_url + '/' + comment.attr('data-id');
    comment.closest('.segment').addClass('loading');
    //Ajax call to remove the file
    $.ajax({
        method: 'POST',
        url: full_url,
        data: {
            comment: comment.val(),
            _method: 'PUT',
            _token: app_token,
        },
        error: function () {
            display_flash_msg(msg = 'Error saving comment to the image');
            comment.closest('.segment').removeClass('loading');
        }
    }).done(function (message) {
        comment.closest('.segment').removeClass('loading');
    });
});



