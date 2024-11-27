<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Music;
use App\Enums\UserRole;
use Illuminate\Auth\Access\Response;

class MusicPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Music $music): bool
    {
        // All users can view music
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // All users can create music
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Music $music): bool
    {
        // Only supervisors or admins can edit
        return in_array($user->role, [UserRole::SUPERVISOR->value, UserRole::ADMIN->value]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Music $music): bool
    {
        // Only admins can delete
        return $user->role === UserRole::ADMIN->value;
    }
}
