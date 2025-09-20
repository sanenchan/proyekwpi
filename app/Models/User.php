<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    use HasFactory, Notifiable, HasRoles;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    // 🔹 Dinamis multi-role
    public function canAccessPanel(Panel $panel): bool
    {
        // Semua user login bisa masuk panel
        return true;
    }

}
// public function canAccessPanel(Panel $panel): bool
//     {
//         // Contoh: hanya role Admin yang boleh masuk ke panel
//         return $this->hasRole('Admin');
//     }
// public static function canViewAny(): bool
// {
//     /** @var \App\Models\User|null $user */
//     $user = Filament::auth()?->user();
//     if (!$user)
//         return false;

//     $modelName = class_basename(static::getModel());
//     $permissionName = "view $modelName";

//     return $user->can($permissionName);
// }