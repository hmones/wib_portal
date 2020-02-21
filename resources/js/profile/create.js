// Page initializations
$(function() {
    $('.ui.dropdown')
        .dropdown()
    ;
    $('.checkbox').checkbox();
    $('#user_form').form({
        on:'blur',
        inline: true,
        fields: {
            title: {rules: [{type: 'empty', prompt: 'Please select a title'}]},
            birth_year: {rules: [{type: 'empty'}, {type: 'integer[1000..2050]', prompt: 'Please enter a valid year'}]},
            name: {rules: [{type: 'empty', prompt: 'Please select an organization name'}, {type: 'maxLength[255]'}]},
            gender: {rules: [{type: 'empty'}]},
            email: {rules: [{type: 'email', prompt: 'Please enter a valid email'}]},
            email_confirm: {rules: [{type: 'match[email]', prompt: 'Email does not match'}]},
            password: {rules: [{type: 'empty'}, {type: 'minLength[6]'}]},
            password_confirm: {rules: [{type: 'match[password]', prompt: 'Password does not match'}]},
            bio: {optional: true, rules: [{type: 'maxLength[3000]'}]},
            phone_country_code: {rules: [{type: 'empty'}]},
            phone: {rules: [{type: 'maxLength[20]'}, {type: 'integer'}]},
            fax: {optional: true, rules: [{type: 'maxLength[20]'}, {type: 'integer'}]},
            link_1: {optional: true, rules: [{type: 'url'}]},
            link_2: {optional: true, rules: [{type: 'url'}]},
            link_3: {optional: true, rules: [{type: 'url'}]},
            link_4: {optional: true, rules: [{type: 'url'}]},
            link_5: {optional: true, rules: [{type: 'url'}]},
            country_id: {rules: [{type: 'empty'}]},
            city_id: {rules:[{type:'empty'}]},
            postal_code: {optional:true,rules:[{type:'empty'},{type:'maxLength[50]'}]},
            sector_1:{rules:[{type:'empty'}]},
            education:{rules:[{type:'empty'}]},
            gdpr_consent:{rules:[{type:'checked'}]},
        }
    });
});


// Navigation for steps
$('#personal_info').click(function () {
    $('#personal_info_form').show();
    $('#portal_info_form').hide();
    $('#personal_info').addClass('active');
    $('#portal_info').removeClass('active');
});
$('#portal_info').click(function () {
    $('#personal_info_form').hide();
    $('#portal_info_form').show();
    $('#personal_info').removeClass('active');
    $('#portal_info').addClass('active');
});

function person_step(){
    $('#personal_info').trigger('click');
}
function portal_step(){
    $('#portal_info').trigger('click');
}


$('input[name="country_id"]').change(function(){
    update_cities('input[name="country_id"]', '#city_id');
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
                password: $('input[name="password"]').val(),
                bio: $('textarea[name="bio"]').val(),
                links: web_links,
                country_id: $('input[name="country_id"]').val(),
                city_id: $('input[name="city_id"]').val(),
                postal_code: $('input[name="postal_code"]').val(),
                education: $('input[name="education"]').val(),
                sector_1: $('input[name="sector_1"]').val(),
                sector_2: $('input[name="sector_2"]').val(),
                sector_3: $('input[name="sector_3"]').val(),
                business_association_wom: $('input[name="business_association_wom"]').val(),
                mena_diaspora: mena_diaspora,
                newsletter: newsletter,
                gdpr_consent: gdpr_consent,
                _token: app_token,
                _method: $('input[name="_method"]').val(),
            },
            error: function(){
                display_flash_msg();
                $('#user_submit').removeClass('loading');
                window.scrollTo(0, 0);
            }
        }).done(function(msg){
            if(msg['message']!='success'){
                console.log(msg['message']);
                display_flash_msg('#flash_message', 'error' , msg = msg['message']);
                $('#user_submit').removeClass('loading');
                window.scrollTo(0, 0);
            }else{
                window.location.href = login_url;
            }
        });
    }else{
        $('#user_form').form('validate form');
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

