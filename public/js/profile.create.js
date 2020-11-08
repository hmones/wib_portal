// Page initializations
$(function () {
    $('.ui.dropdown')
        .dropdown()
        ;
    $('.checkbox').checkbox();
    update_cities('input[name="user[country_id]"]', '#city_id', city_id);
    $('#user_form').form({
        on: 'blur',
        inline: true,
        fields: {
            title: { identifier: 'user[title]', rules: [{ type: 'empty', prompt: 'Please select a title' }] },
            birth_year: { identifier: 'user[birth_year]', rules: [{ type: 'empty' }, { type: 'integer[1000..2050]', prompt: 'Please enter a valid year' }] },
            name: { identifier: 'user[name]', rules: [{ type: 'empty', prompt: 'Please select an organization name' }, { type: 'maxLength[255]' }] },
            gender: { identifier: 'user[gender]', rules: [{ type: 'empty' }] },
            email: { identifier: 'user[email]', rules: [{ type: 'email', prompt: 'Please enter a valid email' }] },
            email_confirmation: { identifier: 'user[email_confirmation]', rules: [{ type: 'match[user[email]]', prompt: 'Email does not match' }] },
            password: { identifier: 'user[password]', rules: [{ type: 'empty' }, { type: 'minLength[6]' }] },
            password_confirmation: { identifier: 'user[password_confirmation]', rules: [{ type: 'match[user[password]]', prompt: 'Password does not match' }] },
            bio: { identifier: 'user[bio]', optional: true, rules: [{ type: 'maxLength[3000]' }] },
            phone_country_code: { identifier: 'user[phone_country_code]', rules: [{ type: 'empty' }] },
            phone: { identifier: 'user[phone]', rules: [{ type: 'maxLength[20]' }, { type: 'integer' }] },
            link: { identifier: 'link[][url]', optional: true, rules: [{ type: 'url' }] },
            country_id: { identifier: 'user[country_id]', rules: [{ type: 'empty' }] },
            city_id: { identifier: 'user[city_id]', rules: [{ type: 'empty' }] },
            postal_code: { identifier: 'user[postal_code]', optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[50]' }] },
            sector_1: { identifier: 'sectors[0][sector_id]', rules: [{ type: 'empty' }] },
            education: { identifier: 'user[education]', rules: [{ type: 'empty' }] },
            gdpr_consent: { identifier: 'user[gdpr_consent]', rules: [{ type: 'checked' }] },
        }
    });
});


// Navigation for steps
$(document).on('click', '#personal_info', function () {
    $('#personal_info_form').show();
    $('#portal_info_form').hide();
    $('#personal_info').addClass('active');
    $('#portal_info').removeClass('active');
});
$(document).on('click', '#portal_info', function () {
    $('#personal_info_form').hide();
    $('#portal_info_form').show();
    $('#personal_info').removeClass('active');
    $('#portal_info').addClass('active');
});

function person_step() {
    $('#personal_info').trigger('click');
}
function portal_step() {
    $('#portal_info').trigger('click');
}


$(document).on('change', 'input[name="user[country_id]"]', function () {
    update_cities('input[name="user[country_id]"]', '#city_id');
});

$(document).on('click', '#user_submit', function () {
    if ($('#user_form').form('is valid')) {
        $('#user_form').trigger('submit');
    } else {
        display_flash_msg();
        person_step();
        $('#user_form').form('validate form');

    }
});

$(document).on('click', '#avatar_upload_icon', function () {
    $('#avatar_upload_input').trigger('click');
});

$(document).on('change', '#avatar_upload_input', function () {
    var file = $(this)[0].files[0];
    if (file != null && file.size < 2000000) {
        var image_html = "<img class='ui circular centered small image' style='height:150px;' src=''/>";
        var reader = new FileReader();
        reader.onload = function () {
            var html = $(image_html).attr('src', reader.result);
            $('#avatar_upload_icon').html(html);
            $('div.image.description small').css('color', 'black');
        }
        reader.readAsDataURL(file);
    } else {
        display_flash_msg('#flash_message', 'error', 'Error uploading the image, images should be png or jpg and less than 2MB');
        $('#avatar_upload_icon').html('<i class="circular red info huge icon" ></i>');
        $('div.image.description small').css('color', 'red');
    }
});

