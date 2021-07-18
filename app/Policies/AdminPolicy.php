<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function update(Admin $user, Admin $admin): bool
    {
        return $user->id === $admin->id;
    }
}
