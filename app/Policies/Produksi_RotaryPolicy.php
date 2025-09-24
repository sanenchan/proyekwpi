<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Produksi_Rotary;
use Illuminate\Auth\Access\HandlesAuthorization;

class Produksi_RotaryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProduksiRotary');
    }

    public function view(AuthUser $authUser, Produksi_Rotary $produksiRotary): bool
    {
        return $authUser->can('View:ProduksiRotary');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProduksiRotary');
    }

    public function update(AuthUser $authUser, Produksi_Rotary $produksiRotary): bool
    {
        return $authUser->can('Update:ProduksiRotary');
    }

    public function delete(AuthUser $authUser, Produksi_Rotary $produksiRotary): bool
    {
        return $authUser->can('Delete:ProduksiRotary');
    }

    public function restore(AuthUser $authUser, Produksi_Rotary $produksiRotary): bool
    {
        return $authUser->can('Restore:ProduksiRotary');
    }

    public function forceDelete(AuthUser $authUser, Produksi_Rotary $produksiRotary): bool
    {
        return $authUser->can('ForceDelete:ProduksiRotary');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProduksiRotary');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProduksiRotary');
    }

    public function replicate(AuthUser $authUser, Produksi_Rotary $produksiRotary): bool
    {
        return $authUser->can('Replicate:ProduksiRotary');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProduksiRotary');
    }

}