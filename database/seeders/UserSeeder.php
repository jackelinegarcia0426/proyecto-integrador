<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener roles
        $adminRole = Role::where('nombre', 'admin')->first();
        $userRole = Role::where('nombre', 'user')->first();

        // Crear usuario admin
        User::firstOrCreate(
            ['email' => 'admin@ejemplo.com'],
            [
                'name' => 'Admin Usuario',
                'password' => Hash::make('password'),
                'rol_id' => $adminRole?->id,
            ]
        );

        // Crear usuario normal
        User::firstOrCreate(
            ['email' => 'usuario@ejemplo.com'],
            [
                'name' => 'Usuario Normal',
                'password' => Hash::make('password'),
                'rol_id' => $userRole?->id,
            ]
        );
    }
}
