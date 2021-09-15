<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class B2bApplicationPolicy
{
    use HandlesAuthorization;

    public function store(User $user)
    {
        return true;
    }
}
