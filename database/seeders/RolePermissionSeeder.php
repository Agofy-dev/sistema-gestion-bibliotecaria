<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class RolePermissionSeeder extends Seeder
{
    private function populateSuperAdminPermissions(): void
    {
        $superAdminRole = Role::where('key', 'super_admin')->first();
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $superAdminRole->addPermission($permission);
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->populateSuperAdminPermissions();
    }
}
