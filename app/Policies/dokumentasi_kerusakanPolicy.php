<?php

namespace App\Policies;

use App\Models\User;
use App\Models\dokumentasi_kerusakan;
use Illuminate\Auth\Access\Response;

class dokumentasi_kerusakanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'crew']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, dokumentasi_kerusakan $dokumentasiKerusakan): bool
    {
        return in_array($user->role, ['admin', 'crew']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'crew']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, dokumentasi_kerusakan $dokumentasiKerusakan): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, dokumentasi_kerusakan $dokumentasiKerusakan): bool
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
    public function restore(User $user, dokumentasi_kerusakan $dokumentasiKerusakan): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, dokumentasi_kerusakan $dokumentasiKerusakan): bool
    {
        return $user->role === 'admin';
    }
}
