<?php
// Verificar que la ruta y componentes de manage-users funcionan
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Role;

// Obtener todos los usuarios y roles
$users = User::with('rol')->paginate(20);
$roles = Role::all();

echo "=== TEST: Gestionar Usuarios ===\n";
echo "Usuarios: " . count($users) . "\n";
echo "Roles: " . count($roles) . "\n\n";

// Verificar que la ruta existe
echo "Verificando rutas disponibles...\n";
$routes = app(\Illuminate\Routing\Router::class)->getRoutes();
$found = false;
foreach ($routes as $route) {
    if ($route->getName() === 'admin.role.update-user') {
        echo "✓ Ruta 'admin.role.update-user' encontrada\n";
        echo "  Método: " . implode(', ', $route->methods) . "\n";
        echo "  URI: " . $route->uri . "\n";
        $found = true;
        break;
    }
}

if (!$found) {
    echo "✗ Ruta 'admin.role.update-user' NO encontrada\n";
    exit(1);
}

// Verificar que el controlador existe
echo "\nVerificando controlador RoleController...\n";
try {
    $controller = new \App\Http\Controllers\RoleController();
    echo "✓ RoleController cargado\n";
    
    // Verificar que los métodos existen
    if (method_exists($controller, 'manageUsers')) {
        echo "✓ Método 'manageUsers' existe\n";
    } else {
        echo "✗ Método 'manageUsers' NO existe\n";
    }
    
    if (method_exists($controller, 'updateUserRole')) {
        echo "✓ Método 'updateUserRole' existe\n";
    } else {
        echo "✗ Método 'updateUserRole' NO existe\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n✅ TODO OK - Gestión de usuarios debería funcionar\n";
