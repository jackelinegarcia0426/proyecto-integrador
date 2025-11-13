<?php

// Test basic routes
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

try {
    // Test if controllers load
    echo "✓ BookController loading...";
    $controller = new \App\Http\Controllers\Admin\BookController();
    echo " OK\n";
    
    echo "✓ RoleController loading...";
    $roleController = new \App\Http\Controllers\RoleController();
    echo " OK\n";
    
    echo "✓ Models loading...";
    \App\Models\Book::class;
    \App\Models\Role::class;
    \App\Models\User::class;
    echo " OK\n";
    
    echo "\n✅ No errors found!\n";
} catch (\Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
