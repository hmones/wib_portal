<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\FileStorage;
use App\Repositories\ProfileHelper;

class UserObserver
{
    public function deleted(User $user)
    {
        if ($user->links()->exists()) {
            $user->links()->delete();
        }
        if ($user->sectors()->exists()) {
            $user->sectors()->detach();
        }
        $storage = new FileStorage();
        $storage->destroy($user->image);
        $user->owned_entities()->update(['owned_by' => null]);
        $user->entities()->detach();
        $user->posts()->delete();
        $user->comments()->delete();
        $user->reactions()->delete();
    }

    public function created(User $user)
    {
        $helper = new ProfileHelper($user);
        $helper->calculate_store_percentage();
    }
}
