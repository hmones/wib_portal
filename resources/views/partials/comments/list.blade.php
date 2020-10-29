<div class="ui feed">
    @forelse ($comments as $comment)
    @include('partials.comments.comment', $comment)
    @empty
    <span style="color:grey;">No comments yet, be the first to comment!</span>
    @endforelse
</div>