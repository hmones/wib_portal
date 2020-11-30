<div class="ui padded raised segment" id="post_{{$post->id}}">
    @if ($post->user->id === Auth::id())
    <div class="floating ui circular red label" style="padding-left:3px !important;"><i class="delete icon"
            data-post-id="{{$post->id}}"></i></div>
    @endif
    <div class="ui stackable grid">
        <div class="six wide column ui list">
            <div class="item">
                @include('partials.components.avatar',['user'=>$post->user, 'type' => 'user'])
                <div class="content">
                    <a class="header" href="{{$post->user->path}}">{{$post->user->name}}</a>
                    <div class="description">{{$post->created_at->diffForHumans()}}</div>
                </div>
            </div>
        </div>
        @if ($post->post_type or isset($post->country) or isset($post->sector))
        <div class="ten wide column">
            <div class="ui basic right aligned segment" style="padding-top:0px;">
                @if($post->post_type)
                Looking for <i class="yellow lightbulb icon" style="margin-right: 0px;"></i> <a
                    href="#">{{$post->post_type}}</a>
                @endif
                @isset($post->country)
                in
                <i class="map marker alternate red icon" style="margin-right: 0px;"></i><a
                    href="#">{{$post->country->name}}</a>
                @endisset
                @isset($post->sector)
                for
                <i class="{{$post->sector->icon}} blue icon" style="margin-right: 0px;"></i>
                <a href="#">{{$post->sector->name}}</a>
                @endisset
            </div>
        </div>
        @endif
    </div>
    <div class="ui basic segment" style="margin-top:0px;">
        {{$post->content}}
        @if($post->image)
        <div class="ui divider"></div>
        <img class="ui image" src="{{$post->image}}" alt="">
        @endif
    </div>
    <div class="ui divider"></div>
    <div class="ui stackable grid">
        <div class="four column row">
            <div class="left floated column">
                @include('partials.likes.show',['reactions' => $post->reactions, 'id'=>$post->id,
                'type'=>'App\Models\Post'])
            </div>
            <div class="right floated right aligned column">
                <a href="{{route('messenger')}}"> <i class="paper plane teal icon"></i> Send Message</a>
            </div>
        </div>
    </div>
    <div class="ui divider"></div>
    @include('partials.comments.new', ['id'=>$post->id,'type'=>'App\Models\Post'])
    <div class="ui feed new comments" data-post-id="{{$post->id}}"></div>
    @include('partials.comments.list', ['comments' => $post->comments->take(3)])
    <div class="extra comments" data-post-id="{{$post->id}}"></div>
    @if ($post->comments->count()>3)
    <div class="ui basic segment">
        <a class="load_more_comments_btn" href="javascript:void(0);" data-post-id="{{$post->id}}" data-page="1"
            data->Load more
            comments ...</a>
    </div>
    @endif
</div>