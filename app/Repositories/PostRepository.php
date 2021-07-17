<?php

namespace App\Repositories;

class PostRepository
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function destroyMany($posts): void
    {
        foreach ($posts as $post) {
            $this->destroy($post);
        }
    }

    public function destroy($post): void
    {
        $this->commentRepository->destroyMany($post->comments);
        $post->reactions()->delete();
        $post->delete();
    }
}
