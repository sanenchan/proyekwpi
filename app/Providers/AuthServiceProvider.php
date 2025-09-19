<?php

namespace App\Providers;

// use App\Models\User;
// use App\Policies\UserPolicy;
// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;

// class AuthServiceProvider extends ServiceProvider
// {
//     /**
//      * The model to policy mappings for the application.
//      *
//      * @var array<class-string, class-string>
//      */
//     protected $policies = [
//         User::class => UserPolicy::class,
//         // Tambahkan model dan policy lainnya di sini sesuai kebutuhan
//         // 'App\Models\Post' => 'App\Policies\PostPolicy',
//         // 'App\Models\Product' => 'App\Policies\ProductPolicy',
//     ];

//     /**
//      * Register any authentication / authorization services.
//      */
//     public function boot(): void
//     {
//         $this->registerPolicies();

//         // Gate untuk super admin (opsional)
//         Gate::define('viewPulse', function ($user) {
//             return $user->hasRole('super_admin');
//         });

//         // Gate untuk Laravel Horizon (jika digunakan)
//         Gate::define('viewHorizon', function ($user) {
//             return $user->hasRole(['super_admin', 'admin']);
//         });

//         // Gate untuk Laravel Telescope (jika digunakan)
//         Gate::define('viewTelescope', function ($user) {
//             return $user->hasRole(['super_admin', 'admin']);
//         });

//         // Gate khusus untuk Filament Shield
//         Gate::before(function ($user, $ability) {
//             // Super admin bisa akses semua
//             if ($user->hasRole('super_admin')) {
//                 return true;
//             }

//             // Return null agar dilanjutkan ke policy/permission check
//             return null;
//         });
//     }
// }