<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SewaWidgetPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    use HandlesAuthorization;

    /**
     * Menentukan apakah pengguna dapat mengakses widget LatestSewa.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewLatestSewa(User $user)
    {
        return $user->hasRole('admin');
    }
}
