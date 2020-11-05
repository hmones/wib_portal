var curr_page = 2;
$(main_container).visibility({
    once: false,
    // update size when new content loads
    observeChanges: true,
    // load content on bottom edge visible
    onBottomVisible: function () {
        if (curr_page > last_page) {
            return;
        }
        var data = {
            page: curr_page,
            _token: app_token,
        };
        var countries = $('input[name="countries[]"]').val();
        var sectors = $('input[name="sectors[]"]').val()
        if (countries != "") {
            data['countries'] = countries;
        }
        if (sectors != "") {
            data['sectors'] = sectors;
        }
        //Ajax call to get new posts
        $.ajax({
            method: 'GET',
            url: url,
            data: data
        }).done(function (message) {
            if (message != 'Error') {
                curr_page++;
                $(message).hide().appendTo(main_container).fadeIn(500);
            }
        });
    }
});