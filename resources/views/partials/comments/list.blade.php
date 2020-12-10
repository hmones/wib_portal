<div class="ui feed old comments">
    @forelse ($comments as $comment)
    @include('partials.comments.comment', $comment)
    @empty
    <span style="margin-left:10px;color:grey;">No comments yet, be the first to comment!</span>
    @endforelse
</div>