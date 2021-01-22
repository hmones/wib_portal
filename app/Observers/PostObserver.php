<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostPublished;
use Illuminate\Database\Eloquent\Builder;

class PostObserver
{
    public function created(Post $post)
    {
        if ($post->sector()->exists()) {
            User::whereHas('sectors', function (Builder $query) use ($post) {
                $query->where('id', $post->sector_id);
            })->where('notify_post', 1)->get()->each->notify(new PostPublished($post));
        }
    }

    public function deleted(Post $post)
    {
        $post->comments()->delete();
    }
}
