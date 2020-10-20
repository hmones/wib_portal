// Page initializations
$(function () {
    $('.ui.dropdown').dropdown();
    $('div.tooltip').popup();
    $('#entity_form').form({
        on: 'blur',
        inline: true,
        fields: {
            entity_type_id: { rules: [{ type: 'empty', prompt: 'Please select an organization type' }] },
            relation: { rules: [{ type: 'empty' }] },
            founding_year: {
                rules: [{ type: 'empty' }, {
                    type: 'integer[1000..2050]',
                    prompt: 'Please enter a valid year'
                }]
            },
            name: { rules: [{ type: 'empty' }, { type: 'maxLength[255]' }] },
            name_additional: { optional: true, rules: [{ type: 'maxLength[255]' }] },
            primary_email: { rules: [{ type: 'email', prompt: 'Please enter a valid email' }] },
            secondary_email: { optional: true, rules: [{ type: 'email', prompt: 'Please enter a valid email' }] },
            phone: { optional: true, rules: [{ type: 'maxLength[20]' }, { type: 'integer' }] },
            fax: { optional: true, rules: [{ type: 'maxLength[20]' }, { type: 'integer' }] },
            entity_link_1: { optional: true, rules: [{ type: 'url' }] },
            entity_link_2: { optional: true, rules: [{ type: 'url' }] },
            entity_link_3: { optional: true, rules: [{ type: 'url' }] },
            entity_link_4: { optional: true, rules: [{ type: 'url' }] },
            entity_link_5: { optional: true, rules: [{ type: 'url' }] },
            primary_address: { rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            primary_country_id: { rules: [{ type: 'empty' }] },
            primary_city_id: { rules: [{ type: 'empty' }] },
            primary_postbox: { optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            primary_postal_code: { optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[50]' }] },
            entity_sector_1: { rules: [{ type: 'empty' }] },
            secondary_address: { optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            secondary_postbox: { optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[100]' }] },
            secondary_postal_code: { optional: true, rules: [{ type: 'empty' }, { type: 'maxLength[50]' }] },
        }
    });
});


$(document).on('change', 'input[name="primary_country_id"]', function () {
    update_cities('input[name="primary_country_id"]', '#primary_city_id');
});

$(document).on('change', 'input[name="secondary_country_id"]', function () {
    update_cities('input[name="secondary_country_id"]', '#secondary_city_id');
});

$(document).on('click', '#entity_submit', function () {
    if ($('#entity_form').form('is valid')) {
        let web_links = [];
        $('input[name^="entity_link_"]').each(function () {
            let temp = {
                'link_type': $(this).attr('data-type'),
                'url': $(this).val()
            };
            web_links.push(temp);
        });
        let photosID = [];
        $('input[name="photosID[]"]').each(function () {
            photosID.push($(this).val());
        });
        $.ajax({
            method: 'POST',
            url: entity_store_url,
            data: {
                logo: $('input[name="logo_id"]').val(),
                entity_type_id: $('input[name="entity_type_id"]').val(),
                relation: $('input[name="relation"]').val(),
                founding_year: $('input[name="founding_year"]').val(),
                name: $('input[name="name"]').val(),
                name_additional: $('input[name="name_additional"]').val(),
                primary_email: $('input[name="primary_email"]').val(),
                secondary_email: $('input[name="secondary_email"]').val(),
                phone_country_code: $('input[name="entity_phone_country_code"]').val(),
                phone: $('input[name="entity_phone"]').val(),
                fax: $('input[name="fax"]').val(),
                links: web_links,
                primary_address: $('input[name="primary_address"]').val(),
                primary_country_id: $('input[name="primary_country_id"]').val(),
                primary_city_id: $('input[name="primary_city_id"]').val(),
                primary_postbox: $('input[name="primary_postbox"]').val(),
                primary_postal_code: $('input[name="primary_postal_code"]').val(),
                secondary_address: $('input[name="secondary_address"]').val(),
                secondary_country_id: $('input[name="secondary_country_id"]').val(),
                secondary_city_id: $('input[name="secondary_city_id"]').val(),
                secondary_postbox: $('input[name="secondary_postbox"]').val(),
                secondary_postal_code: $('input[name="secondary_postal_code"]').val(),
                sector_1: $('input[name="entity_sector_1"]').val(),
                sector_2: $('input[name="entity_sector_2"]').val(),
                sector_3: $('input[name="entity_sector_3"]').val(),
                legal_form: $('input[name="legal_form"]').val(),
                activity: $('input[name="entity_activity"]').val(),
                business_type: $('input[name="business_type"]').val(),
                entity_size: $('input[name="entity_size"]').val(),
                employees: $('input[name="employees"]').val(),
                students: $('input[name="students"]').val(),
                turnover: $('input[name="turnover"]').val(),
                balance_sheet: $('input[name="balance_sheet"]').val(),
                revenue: $('input[name="revenue"]').val(),
                photosID: photosID,
                _method: $('input[name="_method"]').val(),
                _token: app_token,
            }
        }).done(function (msg) {
            if (msg['message'] === 'success') {
                window.location.href = entities_url;
            } else {
                display_flash_msg('#form_errors', 'error', msg = msg['message']);
                window.scrollTo(0, 0);
            }
        });
    } else {
        $('#entity_form').form('validate form');
        window.scrollTo(0, 0);
    }

});


$(document).on('click', '#logo_upload_icon', function () {
    $('#logo_upload_input').trigger('click');
});
$(document).on('change', '#logo_upload_input', function () {
    let file = $('input[name="logo"]')[0].files[0];
    if (file != null) {
        let form = new FormData();
        form.append('new_pp', file);
        form.append('old_pp', $('input[name="logo_id"]').val());
        form.append('_token', app_token);
        console.log(form);
        $('#logo_upload_icon').html('<i class="circular grey inverted huge spinner loading icon"></i>');
        $.ajax({
            method: 'POST',
            url: profile_picture_store_url,
            contentType: false,
            processData: false,
            data: form,
            error: function () {
                display_flash_msg(msg = 'Error uploading the image, images should be png or jpg and less than 2MB');
                $('#logo_upload_icon').html('<i class="circular inverted grey image huge icon"></i>');
            }
        }).done(function (link) {
            let image_html = "<img class='ui circular centered small image' src='" + link.url + "'>";
            $('#logo_upload_icon').html(image_html);
            $('input[name="logo_id"]').val(link.id);
        });
    }
});

