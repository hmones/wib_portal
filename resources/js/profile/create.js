// Page initializations
$(function() {
    $('.ui.dropdown')
        .dropdown()
    ;
    $('.checkbox').checkbox();
    $('#entity_form').form({
        on:'blur',
        inline: true,
        fields: {
            entity_type_id: {rules:[{type:'empty',prompt:'Please select an organization type'}]},
            founding_year: {optional:true,rules:[{type:'integer[1000..2050]', prompt:'Please enter a valid year'}]},
            name: {rules:[{type:'empty',prompt:'Please select an organization name'},{type:'maxLength[255]'}]},
            name_additional: {optional:true, rules:[{type:'maxLength[255]'}]},
            primary_email: {rules:[{type:'email', prompt:'Please enter a valid email'}]},
            secondary_email: {optional:true,rules:[{type:'email', prompt:'Please enter a valid email'}]},
            phone: {optional:true,rules:[{type:'maxLength[20]'},{type:'integer'}]},
            fax: {optional:true,rules:[{type:'maxLength[20]'},{type:'integer'}]},
            entity_link_1: {optional:true,rules:[{type:'url'}]},
            entity_link_2: {optional:true,rules:[{type:'url'}]},
            entity_link_3: {optional:true,rules:[{type:'url'}]},
            entity_link_4: {optional:true,rules:[{type:'url'}]},
            entity_link_5: {optional:true,rules:[{type:'url'}]},
            primary_address: {rules:[{type:'empty'},{type:'maxLength[100]'}]},
            primary_country_id: {rules:[{type:'empty'}]},
            primary_city_id: {rules:[{type:'empty'}]},
            primary_postbox: {optional:true, rules:[{type:'empty'},{type:'maxLength[100]'}]},
            primary_postal_code: {optional:true,rules:[{type:'empty'},{type:'maxLength[50]'}]},
            entity_sector_1:{rules:[{type:'empty'}]},
            secondary_address: {optional:true,rules:[{type:'empty'},{type:'maxLength[100]'}]},
            secondary_postbox: {optional:true, rules:[{type:'empty'},{type:'maxLength[100]'}]},
            secondary_postal_code: {optional:true,rules:[{type:'empty'},{type:'maxLength[50]'}]},
        }
    });
    $('#user_form').form({
        on:'blur',
        inline: true,
        fields: {
            title: {rules:[{type:'empty',prompt:'Please select a title'}]},
            birth_year: {rules:[{type:'empty'},{type:'integer[1000..2050]', prompt:'Please enter a valid year'}]},
            name: {rules:[{type:'empty',prompt:'Please select an organization name'},{type:'maxLength[255]'}]},
            gender: {rules:[{type:'empty'}]},
            email: {rules:[{type:'email', prompt:'Please enter a valid email'}]},
            email_confirm: {rules:[{type:'match[email]', prompt:'Email does not match'}]},
            bio:{optional:true, rules:[{type:'maxLength[3000]'}]},
            phone_country_code: {rules:[{type:'empty'}]},
            phone: {rules:[{type:'maxLength[20]'},{type:'integer'}]},
            fax: {optional:true,rules:[{type:'maxLength[20]'},{type:'integer'}]},
            link_1: {optional:true,rules:[{type:'url'}]},
            link_2: {optional:true,rules:[{type:'url'}]},
            link_3: {optional:true,rules:[{type:'url'}]},
            link_4: {optional:true,rules:[{type:'url'}]},
            link_5: {optional:true,rules:[{type:'url'}]},
            country_id: {rules:[{type:'empty'}]},
            city_id: {rules:[{type:'empty'}]},
            postal_code: {optional:true,rules:[{type:'empty'},{type:'maxLength[50]'}]},
            relation_1:{depends:'entity_1'},
            relation_2:{depends:'entity_2'},
            relation_3:{depends:'entity_3'},
            sector_1:{rules:[{type:'empty'}]},
            education:{rules:[{type:'empty'}]},
            activity:{rules:[{type:'empty'}]},
            sphere:{rules:[{type:'empty'}]},
            gdpr_consent:{rules:[{type:'checked'}]},
        }
    });
});

function display_flash_msg(target='#flash_message', type = 'error', msg = 'There are few errors with your data, please revise it and resubmit your form'){
    let remove_class = 'positive';
    let add_class = 'negative';
    if(type !== 'error')
    {
        let remove_class = 'negative';
        let add_class = 'positive';
    }
    $(target).text(msg).removeClass(remove_class).addClass(add_class).show().delay(1500).fadeOut(400);
}

// Navigation for steps
$('#personal_info').click(function () {
    $('#personal_info_form').show();
    $('#organization_info_form').hide();
    $('#portal_info_form').hide();
    $('#personal_info').addClass('active');
    $('#organization_info').removeClass('active');
    $('#portal_info').removeClass('active');
});
$('#organization_info').click(function () {
    $('#personal_info_form').hide();
    $('#organization_info_form').show();
    $('#portal_info_form').hide();
    $('#personal_info').removeClass('active');
    $('#organization_info').addClass('active');
    $('#portal_info').removeClass('active');
});
$('#portal_info').click(function () {
    $('#personal_info_form').hide();
    $('#organization_info_form').hide();
    $('#portal_info_form').show();
    $('#personal_info').removeClass('active');
    $('#organization_info').removeClass('active');
    $('#portal_info').addClass('active');
});

function entity_step(){
    $('#organization_info').trigger('click');
}
function person_step(){
    $('#personal_info').trigger('click');
}
function portal_step(){
    $('#portal_info').trigger('click');
}


function register_open(){
    $('.ui.modal')
        .modal('show')
    ;
}

function update_cities(country_selector, city_selector)
{
    let value = $(country_selector).val();
    let url = app_url + "/country/" + value;
    console.log(url);
    $.ajax({
        method: 'GET',
        url: url,
    }).done(function(data){
        $(city_selector).dropdown('clear');
        $(city_selector).dropdown('setup menu', {
            values: data['data']['cities']
        });
    });
}

$('input[name="country_id"]').change(function(){
    update_cities('input[name="country_id"]', '#city_id');
});
$('input[name="primary_country_id"]').change(function(){
    update_cities('input[name="primary_country_id"]', '#primary_city_id');
});
$('input[name="secondary_country_id"]').change(function(){
    update_cities('input[name="secondary_country_id"]', '#secondary_city_id');
});

$('#entity_submit').click(function (){
    if( $('#entity_form').form('is valid')) {
        let web_links = [];
        $('input[name^="entity_link_"]').each(function(){
            let temp = {
                'link_type': $(this).attr('data-type'),
                'url': $(this).val()
            };
            web_links.push(temp);
        });
        $.ajax({
            method: 'POST',
            url: entity_store_url,
            data: {
                logo: $('input[name="logo_id"]').val(),
                entity_type_id: $('input[name="entity_type_id"]').val(),
                founding_year: $('input[name="founding_year"]').val(),
                name: $('input[name="entity_name"]').val(),
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
                entity_size:$('input[name="entity_size"]').val(),
                employees: $('input[name="employees"]').val(),
                students: $('input[name="students"]').val(),
                turnover: $('input[name="turnover"]').val(),
                balance_sheet: $('input[name="balance_sheet"]').val(),
                revenue: $('input[name="revenue"]').val(),
                _token: app_token,
            }
        }).done(function(msg){
            if(msg['message']==='success')
            {
                let item = "<div class='item' data-value='" + msg['id'] + "' data-text='" + msg['name'] + "'>"+ msg['name'] +"</div>";
                $('.entity_search_dropdown > div.menu').append(item);
                $('.entity_search_dropdown').dropdown('refresh').dropdown('clear');
                $('.ui.modal').modal('hide');
                $('#flash_message').show()
                    .removeClass('negative')
                    .addClass("positive")
                    .text('Entity Saved Successfully!')
                    .delay(1500)
                    .fadeOut(400)
                ;
            }else{
                display_flash_msg('#form_errors','error', msg = msg['message']);
            }
        });
    }else{
        display_flash_msg('#form_errors','error',  msg = msg['message']);
    }

});
$('#user_submit').click(function (){
    if( $('#user_form').form('is valid')) {
        $('#user_submit').addClass('loading');
        let web_links = [];
        $('input[name^="link_"]').each(function(){
            let temp = {
                'link_type': $(this).attr('data-type'),
                'url': $(this).val()
            };
            web_links.push(temp);
        });
        let mena_diaspora = 0;
        let newsletter = 0;
        let gdpr_consent = 0;

        if ($('input[name="mena_diaspora"]').is(":checked"))
        {
            mena_diaspora = 1;
        }
        if ($('input[name="newsletter"]').is(":checked"))
        {
            newsletter = 1;
        }
        if ($('input[name="gdpr_consent"]').is(":checked"))
        {
            gdpr_consent = 1;
        }
        $.ajax({
            method: 'POST',
            url: profile_store_url,
            data: {
                avatar_id: $('input[name="avatar_id"]').val(),
                title: $('input[name="title"]').val(),
                birth_year: $('input[name="birth_year"]').val(),
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                gender: $('input[name="gender"]').val(),
                phone_country_code: $('input[name="phone_country_code"]').val(),
                phone: $('input[name="phone"]').val(),
                bio: $('textarea[name="bio"]').val(),
                links: web_links,
                country_id: $('input[name="country_id"]').val(),
                city_id: $('input[name="city_id"]').val(),
                postal_code: $('input[name="postal_code"]').val(),
                entity_1: $('input[name="entity_1"]').val(),
                relation_1: $('input[name="relation_1"]').val(),
                entity_2: $('input[name="entity_2"]').val(),
                relation_2: $('input[name="relation_2"]').val(),
                entity_3: $('input[name="entity_3"]').val(),
                relation_3: $('input[name="relation_3"]').val(),
                education: $('input[name="education"]').val(),
                activity: $('input[name="activity"]').val(),
                sphere: $('input[name="sphere"]').val(),
                sector_1: $('input[name="sector_1"]').val(),
                sector_2: $('input[name="sector_2"]').val(),
                sector_3: $('input[name="sector_3"]').val(),
                business_association_wom: $('input[name="business_association_wom"]').val(),
                mena_diaspora: mena_diaspora,
                newsletter:newsletter,
                gdpr_consent: gdpr_consent,
                _token: app_token,
            },
            error: function(){
                display_flash_msg();
                $('#user_submit').removeClass('loading');
            }
        }).done(function(msg){
            if(msg['message']!='success'){
                console.log(msg['message']);
                display_flash_msg('#flash_message', 'error' , msg = msg['message']);
                $('#user_submit').removeClass('loading');
            }else{
                window.location.href = app_url;
            }
        });
    }else{
        display_flash_msg();
    }

});

$('#avatar_upload_icon').click(function () {
    $('#avatar_upload_input').trigger('click');
});

$('#avatar_upload_input').change(function () {
    let file = $('input[name="avatar"]')[0].files[0];
    if(file != null)
    {
        let form = new FormData();
        form.append('new_pp', file);
        form.append('old_pp', $('input[name="avatar_id"]').val());
        form.append('_token', app_token);
        console.log(form);
        $('#avatar_upload_icon').html('<i class="circular grey inverted huge spinner loading icon"></i>');
        $.ajax({
            method: 'POST',
            url: profile_picture_store_url,
            contentType: false,
            processData: false,
            data: form,
            error: function() {
                display_flash_msg(msg = 'Error uploading the image, images should be png or jpg and less than 2MB');
                $('#avatar_upload_icon').html('<i class="circular inverted grey user huge icon" ></i>');
            }
        }).done(function(link){
            let image_html = "<img class='ui circular centered small image' src='"+link.url+"'>";
            $('#avatar_upload_icon').html(image_html);
            $('input[name="avatar_id"]').val(link.id);
        });
    }
});
$('#logo_upload_icon').click(function () {
    $('#logo_upload_input').trigger('click');
});
$('#logo_upload_input').change(function () {
    let file = $('input[name="logo"]')[0].files[0];
    if(file != null)
    {
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
            error: function() {
                display_flash_msg(msg = 'Error uploading the image, images should be png or jpg and less than 2MB');
                $('#logo_upload_icon').html('<i class="circular inverted grey image huge icon"></i>');
            }
        }).done(function(link){
            let image_html = "<img class='ui circular centered small image' src='"+link.url+"'>";
            $('#logo_upload_icon').html(image_html);
            $('input[name="logo_id"]').val(link.id);
        });
    }
});

