<?php

namespace App\Policies;

use App\Models\User;
use App\Models\maintenance_item;
use Illuminate\Auth\Access\Response;

class maintenance_itemPolicy
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
    public function view(User $user, maintenance_item $maintenanceItem): bool
    {
        return in_array($user->role, ['admin', 'crew']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'crew';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, maintenance_item $maintenanceItem): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, maintenance_item $maintenanceItem): bool
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
    public function restore(User $user, maintenance_item $maintenanceItem): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, maintenance_item $maintenanceItem): bool
    {
        return $user->role === 'admin';
    }
}
