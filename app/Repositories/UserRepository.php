<?php

namespace App\Repositories;

use App\Models\Message;

class UserRepository
{
    protected $commentRepository, $postRepository, $fileStorage;

    public function __construct(CommentRepository $commentRepository, PostRepository $postRepository, FileStorage $fileStorage)
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->fileStorage = $fileStorage;
    }

    public function destroy($user): void
    {
        if ($user->links()->exists()) {
            $user->links()->delete();
        }

        if ($user->sectors()->exists()) {
            $user->sectors()->detach();
        }

        $user->entities()->detach();
        $user->owned_entities()->update(['owned_by' => null]);

        $this->fileStorage->destroy($user->image);

        $user->reactions()->delete();

        $this->commentRepository->destroyMany($user->comments);
        $this->postRepository->destroyMany($user->posts);

        Message::where('from_id', $user->id)->orWhere('to_id', $user->id)->delete();

        $user->delete();
    }
}
