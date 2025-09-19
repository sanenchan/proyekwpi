<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua permission yang sudah digenerate oleh Shield
        $permissions = Permission::all();

        // Pastikan role 'admin' ada
        $admin = Role::firstOrCreate(['name' => 'admin']);

        // Admin = super admin -> punya semua izin
        $admin->syncPermissions($permissions);
    }
}
