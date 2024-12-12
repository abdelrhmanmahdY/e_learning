<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $authUser)
    {
        return $authUser->hasRole('admin'); // Only admin can view all users
    }

    
    public function view(User $user, User $model)
    {
        return $user->id === $model->id || $user->isAdmin();
    }

    public function update(User $authUser, User $user)
    {
        return $authUser->id === $user->id || $authUser->hasRole('admin'); // Only owner or admin can update
    }

    public function delete(User $authUser, User $user)
    {
        return $authUser->hasRole('admin'); // Only admin can delete accounts
    }
}
