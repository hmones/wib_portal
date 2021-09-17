@extends('layouts.default')
@section('title', 'Notifications')
@section('content')
    <div class="ui container">
        <h1 class="ui blue page header">Notifications</h1>
        <div class="page subheader">Read all your notifications on women in business portal</div>
        <br>
        <a href="{{route('notifications')}}?unread=true">
            Mark all unread <i class="check icon"></i>
        </a>
        <br><br>

            @if($notifications->count())
            <div class="ui padded basic segment" style="padding-top:0px;margin-top:0px;">
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
                <span style="color: #a7a7a7;">You have no notifications</span>
            @endif

    </div>

@endsection
