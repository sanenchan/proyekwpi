<?php

namespace App\Policies;

use App\Models\Produksi_Rotary;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProduksiRotaryPolicy
{
    /**
     * Lihat semua data Produksi Rotary
     */
    public function viewAny(User $user): bool
    {
        return $user->can('produksi__rotary.view');
    }

    /**
     * Lihat 1 record Produksi Rotary
     */
    public function view(User $user, Produksi_Rotary $produksiRotary): bool
    {
        return $user->can('produksi__rotary.view');
    }

    /**
     * Buat data baru
     */
    public function create(User $user): bool
    {
        return $user->can('produksi__rotary.create');
    }

    /**
     * Update data
     */
    public function update(User $user, Produksi_Rotary $produksiRotary): bool
    {
        return $user->can('produksi__rotary.edit');
    }

    /**
     * Hapus data
     */
    public function delete(User $user, Produksi_Rotary $produksiRotary): bool
    {
        return $user->can('produksi__rotary.delete');
    }

    /**
     * Restore data (kalau pakai soft delete)
     */
    public function restore(User $user, Produksi_Rotary $produksiRotary): bool
    {
        return false;
    }

    /**
     * Force delete data
     */
    public function forceDelete(User $user, Produksi_Rotary $produksiRotary): bool
    {
        return false;
    }
}
