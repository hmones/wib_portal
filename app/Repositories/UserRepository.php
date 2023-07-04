<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    public function __construct(
        protected CommentRepository $commentRepository,
        protected PostRepository $postRepository,
        protected FileStorage $fileStorage
    ) { }

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

    public function calculateCompletion(array $data): string
    {
        $filled = 0;
        foreach ($data as $record) {
            if (!empty($record)) {
                $filled++;
            }
        }

        return number_format(($filled / sizeof($data)) * 100);
    }
}
