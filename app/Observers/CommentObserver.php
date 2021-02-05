<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentPublished;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $post = Post::find($comment->commentable_id);
        $post->user->notify(new CommentPublished($comment->commentable, $comment));
    }
}
