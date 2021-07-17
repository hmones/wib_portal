<?php

namespace App\Repositories;

class CommentRepository
{
    public function destroyMany($comments): void
    {
        foreach ($comments as $comment) {
            $this->destroy($comment);
        }
    }

    public function destroy($comment): void
    {
        $comment->reactions()->delete();
        $comment->delete();
    }
}
