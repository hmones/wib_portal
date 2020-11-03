@extends('layouts.default')
@section('title','Registered members')
@section('content')
<div class="ui centered container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered members</h1>
    <br>
    @include('partials.filter_section', ['route' => route('profile.index')])
    <br><br>
    <div class="ui four column stackable grid" id="profiles_list">
        @include('partials.profile.list', $users)
    </div>
</div>
<br><br><br>
<br><br>

@endsection

@section('scripts')
<script>
    var url = "{{route('profiles.get.api')}}";
    var curr_page = 2;
    var last_page = {{$users->lastPage()}};
    var app_token = "{{Session::token()}}";
    $('#profiles_list').visibility({
        once: false,
        // update size when new content loads
        observeChanges: true,
        // load content on bottom edge visible
        onBottomVisible: function() {
            if(curr_page > last_page){
                return;
            }
            var data = {
                page: curr_page,
                _token: app_token,
            };
            var countries = $('input[name="countries[]"]').val();
            var sectors = $('input[name="sectors[]"]').val()
            if(countries != ""){
                data['countries'] = countries;
            }
            if(sectors != ""){
                data['sectors'] = sectors;
            }
            //Ajax call to get new posts
            $.ajax({
                method: 'GET',
                url: url,
                data: data
            }).done(function (message) {
                if(message != 'Error'){
                    curr_page++;
                    $(message).hide().appendTo('#profiles_list').fadeIn(500);
                }
            });
        }
    });
</script>
@endsection