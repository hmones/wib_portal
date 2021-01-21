@extends('layouts.default')
@section('title', 'Notifications')
@section('content')
<div class="ui container">
    <h1 class="ui blue header"><i class="stop wib bullet icon"></i>Notifications</h1>

    @if($notifications->count())
    <div class="ui padded basic segment" style="padding-top:0px;margin-top:0px;">
        <div class="ui right floated basic segment" style="margin-bottom: 0px;">
            <a href="{{route('notifications')}}?unread=true"><i class="double check icon"></i> Mark all
                as read</a>
        </div>

        <div class="ui feed" style="margin-top:0px">
            @foreach ($notifications as $notification)
            @if($notification->type =='App\Notifications\CommentPublished')
            <div class="{{$notification->read_at?'read':'unread'}} notification event">
                <div class="label">
                    <img class="ui avatar image"
                        src="{{$notification->data['comment_author_img']?$notification->data['comment_author_img']:asset('images/female_avatar.jpg')}}"
                        alt="">
                </div>
                <div class="content">
                    <div class="summary">
                        <a class="user">
                            {{$notification->data['comment_author']}}
                        </a> commented on your <a
                            href="{{route('home')}}?id={{$notification->data['post_id']}}">post</a>
                        <div class="date">
                            {{Carbon\Carbon::parse($notification->data['comment_date'])->diffForHumans()}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @else
    <div class="ui very padded basic segment">
        <i class="circular info blue icon"></i> No notifications to display
    </div>
    @endif
</div>

@endsection