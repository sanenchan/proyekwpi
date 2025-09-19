<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function canAccessPanel(Panel $panel): bool
    {
        // Implementasi logic untuk menentukan siapa yang bisa akses panel
        return true; // atau logic yang lebih spesifik
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