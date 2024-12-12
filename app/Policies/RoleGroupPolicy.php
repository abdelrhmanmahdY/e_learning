<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rolegroup;

class RoleGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the role group.
     */
    public function view(User $user, rolegroup $roleGroup)
    {
        return $user->id === $roleGroup->user_id;
    }

    public function update(User $user, rolegroup $roleGroup)
    {
        return $user->id === $roleGroup->user_id;
    }

}
