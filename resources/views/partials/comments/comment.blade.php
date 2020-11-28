<div class="event ui comment" data-id="{{$comment->id}}">
    <div class="label">
        @include('partials.components.avatar', ['user'=>$comment->user, 'type' => 'user'])
    </div>
    <div class="content">
        <div class="summary">
            <a href="{{route('profile.show',['profile'=>$comment->user])}}">{{$comment->user->name}}</a> commented
            <div class="date">
                {{$comment->created_at->diffForHumans()}}
                @can('delete', $comment)
                &nbsp;&nbsp; <a class="delete comment btn" data-comment-id="{{$comment->id}}"
                    href="javascript:void(0);">delete</a>
                @endcan
            </div>
        </div>
        <div class="extra text">
            {{$comment->content}}
        </div>
        <div class="meta">
            @include('partials.likes.show',['reactions'=>$comment->reactions, 'id'=>$comment->id,
            'type'=>'App\Models\Comment'])
        </div>
    </div>
</div>