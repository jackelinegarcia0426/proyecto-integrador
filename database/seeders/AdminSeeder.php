<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener o crear el rol de admin
        $adminRole = Role::where('nombre', 'admin')->first();
        if (!$adminRole) {
            $adminRole = Role::create(['nombre' => 'admin', 'descripcion' => 'Administrador del sistema']);
        }

        // Crear usuario admin
        User::updateOrCreate(
            ['email' => 'admin@ejemplo.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('contrseañ'),
                'rol_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
