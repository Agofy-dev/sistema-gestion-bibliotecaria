<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
    ['email' => 'angelgabrielocquefigueroa123@gmail.com'],
    [
        'name' => 'Ángel',
        'second_name' => 'Gabriel',
        'last_name' => 'Ocque',
        'second_last_name' => 'Figueroa',
        'cedula' => '30143976',
        'telefono' => '0424-8471775',
        'password' => Hash::make('admin123'), // <-- Usa Hash::make() aquí
        'role_id' => 1,
    ]
);
    }
}
