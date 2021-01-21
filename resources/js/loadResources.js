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
        var countries = $('input[name="countries"]').val();
        var sectors = $('input[name="sectors"]').val();
        var is_verified = $('input[name="is_verified"][checked]').val();
        var last_login = $('input[name="last_login"][checked]').val();
        var name = $('input[name="name"]').val();
        if (countries != "") {
            data['countries'] = countries;
        }
        if (sectors != "") {
            data['sectors'] = sectors;
        }
        if (is_verified != "") {
            data['is_verified'] = is_verified;
        }
        if (last_login != "") {
            data['last_login'] = last_login;
        }
        if (name != "") {
            data['name'] = name;
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