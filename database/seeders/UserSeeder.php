<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Angel',
            'second_name' => 'Gabriel',
            'last_name' => 'Ocque',
            'second_last_name' => 'Figueroa',
            'email' => 'angelgabrielocquefigueroa123@gmail.com',
            'cedula' => '30143976',
            'telefono' => '04248471775',
            'role_id' => Role::where('key', 'super_admin')->first()->id,
            'password' => \Hash::make('secret'),
        ]);
    }
}
