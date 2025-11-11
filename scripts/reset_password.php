<?php
// Reset contraseña del usuario a 'password'
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'leguizamojesusda@gmail.com')->first();

if ($user) {
    $user->password = Hash::make('password');
    $user->save();
    echo "Contraseña actualizada para: " . $user->email . "\n";
    echo "Nueva contraseña: password\n";
} else {
    echo "Usuario no encontrado\n";
}
