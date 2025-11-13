<?php
// Script para probar autenticación directa
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'leguizamojesusda@gmail.com';
$password = 'jesusernesto1';

$user = User::where('email', $email)->first();

if (!$user) {
    echo "ERROR: Usuario no encontrado\n";
    exit(1);
}

echo "Usuario: " . $user->email . "\n";
echo "Contraseña BD: " . (bool)$user->password . " (exists)\n";
echo "Contraseña hash prefix: " . substr($user->password, 0, 30) . "\n";
echo "getAuthPassword() returns: " . (bool)$user->getAuthPassword() . " (bool)\n";

$check = Hash::check($password, $user->getAuthPassword());
echo "Hash::check('$password', getAuthPassword()): " . ($check ? "OK" : "FAIL") . "\n";

// Test Laravel Auth attempt directly
$attempt = \Illuminate\Support\Facades\Auth::attempt(['email' => $email, 'password' => $password]);
echo "Auth::attempt() result: " . ($attempt ? "SUCCESS" : "FAILED") . "\n";

if ($attempt) {
    $authed = \Illuminate\Support\Facades\Auth::user();
    echo "Authenticated user: " . $authed->email . "\n";
}
