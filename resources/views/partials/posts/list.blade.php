@forelse ($posts as $post)
<div class="ui relaxed divided list">
    @include('partials.posts.post',$post)
</div>
@empty
No posts yet!, please visit back again soon!
@endforelse