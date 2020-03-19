$('.ui.dropdown').dropdown();

$('.message .close')
    .on('click', function () {
        $(this)
            .closest('.message')
            .transition('fade')
        ;
    })
;

function update_cities(country_selector, city_selector) {
    let value = $(country_selector).val();
    let url = app_url + "/country/" + value;
    console.log(url);
    $.ajax({
        method: 'GET',
        url: url,
    }).done(function (data) {
        $(city_selector).dropdown('clear');
        $(city_selector).dropdown('setup menu', {
            values: data['data']['cities']
        });
    });
}

function display_flash_msg(target = '#flash_message', type = 'error', msg = 'There are few errors with your data, please revise it and resubmit your form') {
    let remove_class = 'positive';
    let add_class = 'negative';
    if (type !== 'error') {
        let remove_class = 'negative';
        let add_class = 'positive';
    }
    $(target).text(msg).removeClass(remove_class).addClass(add_class).show().delay(1500).fadeOut(400);
}
