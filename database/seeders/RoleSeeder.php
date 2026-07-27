<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'key' => 'super_admin',
                'name' => 'SuperAdmin (Director)',
                'description' => 'Posee acceso total a la administración y configuración del sistema.',
            ],
            [
                'key' => 'admin',
                'name' => 'Admin (Bibliotecario)',
                'description' => 'Gestión de libros, catálogo, préstamos y usuarios lectores.',
            ],
            [
                'key' => 'lector',
                'name' => 'Lector (Usuario Normal)',
                'description' => 'Usuario registrado para consulta de catálogo y solicitudes de préstamo.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['key' => $role['key']], // Busca por la columna 'key'
                [
                    'name' => $role['name'],
                    'description' => $role['description'],
                ]
            );
        }
    }
}