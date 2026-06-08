<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    private function createPermission(string $name, string $module, string $action): void
    {
        Permission::create([
            'name' => $name,
            'module' => $module,
            'action' => $action,
        ]);
    }

    private function createUsersPermissions(): void
    {
        $this->createPermission(name: 'Crear usuario', module: 'users', action: 'create');
        $this->createPermission(name: 'Leer usuarios', module: 'users', action: 'read');
        $this->createPermission(name: 'Actualizar usuario', module: 'users', action: 'update');
        $this->createPermission(name: 'Eliminar usuario', module: 'users', action: 'delete');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUsersPermissions();
    }
}
