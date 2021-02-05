<?php

namespace App\Jobs;

use App\Models\Message;
use App\Models\User;
use App\Repositories\FileStorage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $fileStorage;

    public function __construct($user)
    {
        $this->user = $user;
        $this->fileStorage = new FileStorage();
    }

    public function handle()
    {
        if ($this->user->links()->exists()) {
            $this->user->links()->delete();
        }
        if ($this->user->sectors()->exists()) {
            $this->user->sectors()->detach();
        }
        $this->user->entities()->detach();
        $this->user->owned_entities()->update(['owned_by' => null]);
        $this->fileStorage->destroy($this->user->image);
        $this->user->reactions()->delete();

        foreach ($this->user->comments()->withoutGlobalScopes()->get() as $comment) {
            DeleteComment::dispatch($comment);
        }

        foreach ($this->user->posts()->withoutGlobalScopes()->get() as $post) {
            DeletePost::dispatch($post);
        }

        Message::where('from_id', $this->user->id)->orWhere('to_id', $this->user->id)->delete();

        $this->user->delete();
        User::where('active', 0)->withoutGlobalScopes()->delete();
    }
}
