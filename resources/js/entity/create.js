// Page initializations
$(function () {
    $('.ui.dropdown').dropdown();
    $('span.tooltip').popup();
    $('#entity_form').form({
        on: 'blur',
        inline: true,
        fields: {
            entity_type_id: { identifier: 'entity[entity_type_id]', rules: [{ type: 'empty', prompt: 'Please select an organization type' }] },
            relation: { identifier: 'users[relation]', rules: [{ type: 'empty' }] },
            founding_year: {
                identifier: 'entity[founding_year]',
                rules: [{ type: 'empty' }, {
                    type: 'integer[1000..2050]',
                    prompt: 'Please enter a valid year'
                }]
            },
            name: { identifier: 'entity[name]', rules: [{ type: 'empty' }, { type: 'maxLength[255]' }] },
            name_additional: { identifier: 'entity[name_additional]', optional: true, rules: [{ type: 'maxLength[255]' }] },
            primary_email: { identifier: 'entity[primary_email]', rules: [{ type: 'email', prompt: 'Please enter a valid email' }] },
            secondary_email: { identifier: 'entity[secondary_email]', optional: true, rules: [{ type: 'email', prompt: 'Please enter a valid email' }] },
            phone: { identifier: 'entity[phone]', optional: true, rules: [{ type: 'maxLength[20]' }, { type: 'integer' }] },
            fax: { identifier: 'entity[fax]', optional: true, rules: [{ type: 'maxLength[20]' }, { type: 'integer' }] },
            entity_link_1: { identifier: 'links[0][url]', optional: true, rules: [{ type: 'url' }] },
            entity_link_2: { identifier: 'links[1][url]', optional: true, rules: [{ type: 'url' }] },
            entity_link_3: { identifier: 'links[2][url]', optional: true, rules: [{ type: 'url' }] },
            entity_link_4: { identifier: 'links[3][url]', optional: true, rules: [{ type: 'url' }] },
            entity_link_5: { identifier: 'links[4][url]', optional: true, rules: [{ type: 'url' }] },
            primary_address: { identifier: 'entity[primary_address]', rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            primary_country_id: { identifier: 'entity[primary_country_id]', rules: [{ type: 'empty' }] },
            primary_city_id: { identifier: 'entity[primary_city_id]', rules: [{ type: 'empty' }] },
            primary_postbox: { identifier: 'entity[primary_postbox]', optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            primary_postal_code: { identifier: 'entity[primary_postal_code]', optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[50]' }] },
            entity_sector_1: { identifier: 'sectors[0][sector_id]', rules: [{ type: 'empty' }] },
            secondary_address: { identifier: 'entity[secondary_address]', optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            secondary_postbox: { identifier: 'entity[secondary_postbox]', optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            secondary_postal_code: { identifier: 'entity[secondary_postal_code]', optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[50]' }] },
        }
    });
});


$(document).on('change', 'input[name="entity[primary_country_id]"]', function () {
    update_cities('input[name="entity[primary_country_id]"]', '#primary_city_id');
});

$(document).on('change', 'input[name="entity[secondary_country_id]"]', function () {
    update_cities('input[name="entity[secondary_country_id]"]', '#secondary_city_id');
});

$(document).on('click', '#entity_submit', function () {
    if ($('#entity_form').form('is valid')) {
        let photosID = [];
        $('input[name="photosID[]"]').each(function () {
            photosID.push($(this).val());
        });
        $('#entity_form').attr('action', entity_store_url).trigger('submit');
    } else {
        $('#entity_form').form('validate form');
        window.scrollTo(0, 0);
    }

});

$(document).on('click', '#logo_upload_icon', function () {
    $('#logo_upload_input').trigger('click');
});

$(document).on('change', '#logo_upload_input', function () {
    var file = $(this)[0].files[0];
    if (file != null && file.size < 2000000) {
        var image_html = "<img class='ui circular centered small image' style='height:150px;' src=''/>";
        var reader = new FileReader();
        reader.onload = function () {
            var html = $(image_html).attr('src', reader.result);
            $('#logo_upload_icon').html(html);
            $('div.image.description small').css('color', 'black');
        }
        reader.readAsDataURL(file);
    } else {
        display_flash_msg('#flash_message', 'error', 'Error uploading the image, images should be png or jpg and less than 2MB');
        $('#logo_upload_icon').html('<i class="circular red info huge icon" ></i>');
        $('div.image.description small').css('color', 'red');
    }
});

