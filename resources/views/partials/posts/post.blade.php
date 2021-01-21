<div class="ui padded raised segment" id="post_{{$post->id}}">
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
                <span style="border-bottom: 2px">
                    <i class="comments teal icon"></i>
                    <span style="color:#666666">
                        @if($post->post_type)
                            Looking for {{$post->post_type}}
                        @endif
                        @isset($post->country)
                            in {{$post->country->name}}
                        @endisset
                        @isset($post->sector)
                            in {{$post->sector->name}}
                        @endisset
                    </span>
                    @if ($post->user->id === Auth::id())
                        <span style="padding-left:20px;">
                        <a class="ui label"><i class="trash icon" style="margin-right:0px"
                                               data-post-id="{{$post->id}}"></i></a>
                    </span>
                    @endif
                </span>

                </div>
            </div>
        @endif
    </div>
    <div class="ui basic segment wib post content">
        {{$post->content}}
        @if($post->image)
            <div class="ui divider"></div>
            <img class="ui image" src="{{$post->image}}" alt="">
        @endif
    </div>
    <div class="ui stackable grid wib post engagement section">
        <div class="four column row">
            <div class="left floated middle aligned column" style="opacity:0.8;padding-left:2em;">
                <i class="blue thumbs up icon"></i>
                <span class="likes count">
                     {{$post->reactions->count()}}
                </span>
                likes
                &nbsp;
                <i class="orange comment icon"></i>
                <span class="comments count">
                    {{$post->comments->count()}}
                </span>
                comments
            </div>
            <div class="right floated ten wide right aligned column column">
                @include('partials.likes.show',['reactions' => $post->reactions, 'id'=>$post->id,
                'type'=>'App\Models\Post'])
                <a href="{{route('messenger')}}" class="ui basic teal mini button"> <i
                            class="paper plane teal icon"></i> Message</a>
            </div>
        </div>
    </div>
    @include('partials.comments.new', ['id'=>$post->id,'type'=>'App\Models\Post'])
    <br/>
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