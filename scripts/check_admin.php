<?php

// Script simple para comprobar existencia del usuario admin y validar su hash de contraseña
// Ejecutar desde la raíz del proyecto: php scripts/check_admin.php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$u = User::where('email', 'admin@ejemplo.com')->first();
if ($u) {
    echo "FOUND: " . $u->email . "\n";
    echo "password_hash_prefix: " . substr($u->password, 0, 20) . "\n";
    echo (password_verify('password', $u->password) ? "Hash OK\n" : "Hash FAIL\n");
} else {
    echo "NOT FOUND\n";
}
