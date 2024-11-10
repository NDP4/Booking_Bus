<?php

namespace App\Policies;

use App\Models\User;
use App\Models\penilaian;
use Illuminate\Auth\Access\Response;

class penilaianPolicy
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
    public function view(User $user, penilaian $penilaian): bool
    {
        return $user->role === 'admin' || $user->id === $penilaian->user_id;
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
    public function update(User $user, penilaian $penilaian): bool
    {
        return $user->role === 'konsumen' && $user->id === $penilaian->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, penilaian $penilaian): bool
    {
        // return $user->role === 'konsumen' && $user->id === $penilaian->user_id;
        return in_array($user->role, ['admin', 'konsumen']);
    }
    public function deleteAny(User $user): bool
    {
        // return $user->role === 'konsumen' && $user->id === $penilaian->user_id;
        return in_array($user->role, ['admin', 'konsumen']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, penilaian $penilaian): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, penilaian $penilaian): bool
    {
        return false;
    }
}
