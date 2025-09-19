<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DetailProduksiRotary;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailProduksiRotaryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DetailProduksiRotary');
    }

    public function view(AuthUser $authUser, DetailProduksiRotary $detailProduksiRotary): bool
    {
        return $authUser->can('View:DetailProduksiRotary');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DetailProduksiRotary');
    }

    public function update(AuthUser $authUser, DetailProduksiRotary $detailProduksiRotary): bool
    {
        return $authUser->can('Update:DetailProduksiRotary');
    }

    public function delete(AuthUser $authUser, DetailProduksiRotary $detailProduksiRotary): bool
    {
        return $authUser->can('Delete:DetailProduksiRotary');
    }

    public function restore(AuthUser $authUser, DetailProduksiRotary $detailProduksiRotary): bool
    {
        return $authUser->can('Restore:DetailProduksiRotary');
    }

    public function forceDelete(AuthUser $authUser, DetailProduksiRotary $detailProduksiRotary): bool
    {
        return $authUser->can('ForceDelete:DetailProduksiRotary');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DetailProduksiRotary');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DetailProduksiRotary');
    }

    public function replicate(AuthUser $authUser, DetailProduksiRotary $detailProduksiRotary): bool
    {
        return $authUser->can('Replicate:DetailProduksiRotary');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DetailProduksiRotary');
    }

}