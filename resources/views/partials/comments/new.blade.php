<form class="ui form create comment">
    @csrf
    <div class="ui icon input fluid field">
        <i class="paper plane link blue icon create comment btn" style="margin-right: 15px;"></i>
        <input type="text" name="content" placeholder="Comment ...." autocomplete="off" class="wib new comment input"/>
        <input type="hidden" name="user_id" value="{{Auth::id()}}" />
        <input type="hidden" name="commentable_id" value="{{$id}}" />
        <input type="hidden" name="commentable_type" value="{{$type}}" />
    </div>
</form>