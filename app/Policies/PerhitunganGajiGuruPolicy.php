<?php

namespace App\Policies;

use App\Models\User;
use App\Models\perhitungan_gaji_guru;
use Illuminate\Auth\Access\Response;

class PerhitunganGajiGuruPolicy
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
    public function view(User $user, perhitungan_gaji_guru $perhitunganGajiGuru): bool
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
    public function update(User $user, perhitungan_gaji_guru $perhitunganGajiGuru): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, perhitungan_gaji_guru $perhitunganGajiGuru): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, perhitungan_gaji_guru $perhitunganGajiGuru): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, perhitungan_gaji_guru $perhitunganGajiGuru): bool
    {
        return false;
    }
}
