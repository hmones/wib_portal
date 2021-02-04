<?php

namespace App\Jobs;

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

    public function __construct(User $user)
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
        $this->user->posts()->delete();
        $this->user->comments()->delete();
        $this->user->reactions()->delete();
    }
}
