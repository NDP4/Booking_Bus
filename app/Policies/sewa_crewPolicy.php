<?php

namespace App\Policies;

use App\Models\User;
use App\Models\sewa_crew;
use Illuminate\Auth\Access\Response;

class sewa_crewPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'crew', 'konsumen']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, sewa_crew $sewaCrew): bool
    {
        // Admin dapat melihat semua data
        // Crew hanya bisa melihat data yang terkait dengan crew mereka
        // Konsumen hanya bisa melihat data yang terkait dengan sewa mereka
        // return $user->role === 'admin' ||
        //     ($user->role === 'crew' && $user->id === $sewaCrew->crew_id) ||
        //     ($user->role === 'konsumen' && $user->id === $sewaCrew->sewa->penyewa_id);

        // Admin dapat melihat semua penugasan
        if ($user->role === 'admin') {
            return true;
        }

        // Crew hanya bisa melihat penugasan untuk mereka sendiri
        if ($user->role === 'crew' && $user->id === $sewaCrew->crew_id) {
            return true;
        }

        // Konsumen hanya bisa melihat penugasan yang terkait dengan sewa mereka sendiri
        if ($user->role === 'konsumen' && $user->id === $sewaCrew->sewa->penyewa_id) {
            return true;
        }

        // Jika tidak cocok, akses ditolak
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, sewa_crew $sewaCrew): bool
    {
        // Admin bisa mengupdate semua data, crew hanya bisa mengupdate data miliknya sendiri
        return $user->role === 'admin' || ($user->role === 'crew' && $user->id === $sewaCrew->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, sewa_crew $sewaCrew): bool
    {
        // Admin bisa menghapus semua data, crew hanya bisa menghapus data miliknya sendiri
        return $user->role === 'admin' || ($user->role === 'crew' && $user->id === $sewaCrew->user_id);
    }
    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, sewa_crew $sewaCrew): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, sewa_crew $sewaCrew): bool
    {
        return $user->role === 'admin';
    }
}
