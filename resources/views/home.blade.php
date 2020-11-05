@extends('layouts.default')
@section('title', 'Home Page')
@section('content')
<div class="ui container" id="posts_container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Member Space</h1>
    @include('partials.posts.new')
    <div id="new_posts"></div>
    @include('partials.posts.list', $posts)
    <div id="extra_posts"></div>
</div>
@endsection
@section('scripts')
<script>
    var posts_url = "{{route('posts.get.api')}}";
    var curr_posts_page = 2;
    var curr_comments_page = [];
    var app_token = "{{Session::token()}}";
    // Displaying more posts
    $('#extra_posts').visibility({
        once: false,
        // update size when new content loads
        observeChanges: true,
        // load content on bottom edge visible
        onBottomVisible: function() {
            var regex = new RegExp("id=.*$");
            var idParameter = window.location.search.substring(1);
            if(!regex.test(idParameter)){
                //Ajax call to get new posts
                $.ajax({
                    method: 'GET',
                    url: posts_url,
                    data: {
                        page: curr_posts_page,
                        _token: app_token,
                    }
                }).done(function (message) {
                    if(message != 'Error'){
                        curr_posts_page++;
                        $(message).hide().appendTo('#extra_posts').fadeIn(500);
                    }
                });
            }
        }
    });
    // Displaying more comments
    $(document).on('click','.load_more_comments_btn',function(){
        var post_id = $(this).attr('data-post-id');
        var comments_url = '/post/'+ post_id +'/comments/';
        if(!(post_id in curr_comments_page)){
            curr_comments_page[post_id] = 2;
        }
        //Ajax call to get new posts
        $.ajax({
            method: 'GET',
            url: comments_url,
            data: {
                page: curr_comments_page[post_id],
                _token: app_token,
            }
        }).done(function (message) {
            if(message === 'Error'){
                $('.load_more_comments_btn[data-post-id="'+post_id+'"]').remove();
            }else{
                curr_comments_page[post_id]++;
                $(message).hide().appendTo('.extra.comments[data-post-id="'+post_id+'"]').fadeIn(500);
            } 
        });
    });
    // Adding new posts
    $(document).on('click','#create_new_post',function(){
        var form = $(this).closest('form');
        form.addClass('loading');
        //Ajax call to get new posts
        $.ajax({
            method: 'POST',
            url: '/post',
            data: {
                content: form.find('textarea[name=content]').val(),
                post_type: form.find('input[name=post_type]').val(),
                country_id: form.find('input[name=country_id]').val(),
                sector_id: form.find('input[name=sector_id]').val(),
                user_id: form.find('input[name=user_id]').val(),
                _token: form.find('input[name=_token]').val(),
            }
        }).done(function (message) {
            $(message).hide().prependTo('#new_posts').fadeIn(1000);
        });
        $(this).closest('form').removeClass('loading').trigger('reset');
    });
    //Deleting posts
    $(document).on('click','.delete.icon',function(){
        var post_id = $(this).attr('data-post-id');
        //Ajax call to get new posts
        $.ajax({
            method: 'POST',
            url: '/post/'+post_id,
            data: {
                _token: app_token,
                _method: "DELETE"
            }
        }).done(function (message) {
            $('#post_'+post_id).fadeOut(1000);
        });
    });
    //Posting New Comment
    $(document).on('click','.create.comment.btn',function(){
        $(this).closest('form').trigger('submit');
    });
    $(document).on('submit','.ui.form.create.comment',function(e){
        e.preventDefault();
        var form = $(this);
        form.addClass('loading');
        $.ajax({
            method: 'POST',
            url: '/comment',
            data: {
                content: form.find('input[name=content]').val(),
                commentable_type: form.find('input[name=commentable_type]').val(),
                commentable_id: form.find('input[name=commentable_id]').val(),
                user_id: form.find('input[name=user_id]').val(),
                _token: form.find('input[name=_token]').val(),
            }
        }).done(function (message) {
            $(message).hide().prependTo('.new.comments[data-post-id='+ form.find('input[name=commentable_id]').val()+']').fadeIn(1000);
        });
        form.removeClass('loading').trigger('reset');
    });
    //Deleting Comment
    $(document).on('click','a.delete.comment.btn', function(){
        var comment_id = $(this).attr('data-comment-id');
        $.ajax({
            method: 'POST',
            url: '/comment/'+comment_id,
            data: {
                _token: app_token,
                _method: "DELETE"
            }
        }).done(function (message) {
            $('.event.ui.comment[data-id='+comment_id+']').fadeOut(1000);
        });
    });
    //Toogle Like
    $(document).on('click','a.thumbs.up.button',function(){
        var element = $(this);
        var type=element.attr('data-type');
        var id=element.attr('data-id');
        var reaction_id=element.attr('data-reaction-id');
        var user_id=element.attr('data-user-id');
        var reactions = parseInt(element.children('span').html());
        if(reaction_id!=0){
            $.ajax({
                method: 'POST',
                url: '/reaction/'+reaction_id,
                data: {
                    _token: app_token,
                    _method: "DELETE"
                }
            }).done(function (message) {
                reactions--;
                element.attr('data-reaction-id',0).css('color','#999999').children('span').html(reactions--);
            });
        }else{
            $.ajax({
                method: 'POST',
                url: '/reaction/',
                data: {
                    _token: app_token,
                    reactionable_type: type,
                    reactionable_id: id,
                    type:0,
                    user_id:user_id
                }
            }).done(function (message) {
                reactions++;
                element.attr('data-reaction-id',message.id).css('color','#4183c4').children('span').html(reactions++);
            });
        }
    });
</script>
@endsection