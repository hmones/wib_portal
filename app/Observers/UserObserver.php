<?php

namespace App\Observers;

use App\Jobs\DeleteUser;
use App\Models\User;
use App\Repositories\ProfileHelper;

class UserObserver
{
    public function deleted(User $user)
    {
        DeleteUser::dispatch($user);
    }

    public function created(User $user)
    {
        $helper = new ProfileHelper($user);
        $helper->calculate_store_percentage();
    }
}
