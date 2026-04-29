<?php

namespace App\Policies;

use App\Models\User;
use App\Models\alat_tulis_kantor;
use Illuminate\Auth\Access\Response;

class AlatTulisKantorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, alat_tulis_kantor $alatTulisKantor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, alat_tulis_kantor $alatTulisKantor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, alat_tulis_kantor $alatTulisKantor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, alat_tulis_kantor $alatTulisKantor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, alat_tulis_kantor $alatTulisKantor): bool
    {
        return false;
    }
}
