<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Facades\Filament;
use Spatie\Permission\Models\Permission;

abstract class BaseResource extends Resource
{
    public static function canViewAny(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Filament::auth()?->user();
        if (!$user)
            return false;

        $modelName = class_basename(static::getModel());
        $permissionName = "view $modelName";

        return $user->can($permissionName);
    }

    public static function boot(): void
    {
        $modelName = class_basename(static::getModel());
        $permissionName = "view $modelName";

        if (!Permission::where('name', $permissionName)->exists()) {
            Permission::create(['name' => $permissionName]);
        }
    }
}
