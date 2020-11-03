@extends('layouts.default')
@section('title', 'Organizations and Businesses')
@section('content')
<div class="ui centered container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Registered Businesses and Organizations</h1>
    <br>
    @include('partials.filter_section', ['route' => route('entity.index')])
    <br><br>
    <div class="ui four column stackable grid" id="entities_list">
        @include('partials.entity.list', $entities)
    </div>
</div>
<br><br><br>

@endsection
@section('scripts')
<script>
    var url = "{{route('entities.get.api')}}";
    var curr_page = 2;
    var last_page = {{$entities->lastPage()}};
    var app_token = "{{Session::token()}}";
    $('#entities_list').visibility({
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
                    $(message).hide().appendTo('#entities_list').fadeIn(500);
                }
            });
        }
    });
</script>
@endsection