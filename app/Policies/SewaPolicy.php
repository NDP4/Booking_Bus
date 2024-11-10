<?php

namespace App\Policies;

use App\Models\Sewa;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SewaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'konsumen']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sewa $sewa): bool
    {
        return $user->role === 'admin' ||
            ($user->role === 'konsumen' && $user->id === $sewa->konsumen_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'konsumen';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sewa $sewa): bool
    {
        return $user->role === 'admin' ||
            ($user->role === 'konsumen' && $user->id === $sewa->konsumen_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sewa $sewa): bool
    {
        return $user->role === 'admin';
    }
    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Sewa $sewa): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Sewa $sewa): bool
    {
        return $user->role === 'admin';
    }
}
