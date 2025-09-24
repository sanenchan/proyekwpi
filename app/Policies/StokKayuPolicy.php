<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StokKayu;
use Illuminate\Auth\Access\HandlesAuthorization;

class StokKayuPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StokKayu');
    }

    public function view(AuthUser $authUser, StokKayu $stokKayu): bool
    {
        return $authUser->can('View:StokKayu');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StokKayu');
    }

    public function update(AuthUser $authUser, StokKayu $stokKayu): bool
    {
        return $authUser->can('Update:StokKayu');
    }

    public function delete(AuthUser $authUser, StokKayu $stokKayu): bool
    {
        return $authUser->can('Delete:StokKayu');
    }

    public function restore(AuthUser $authUser, StokKayu $stokKayu): bool
    {
        return $authUser->can('Restore:StokKayu');
    }

    public function forceDelete(AuthUser $authUser, StokKayu $stokKayu): bool
    {
        return $authUser->can('ForceDelete:StokKayu');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StokKayu');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StokKayu');
    }

    public function replicate(AuthUser $authUser, StokKayu $stokKayu): bool
    {
        return $authUser->can('Replicate:StokKayu');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StokKayu');
    }

}