<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BookSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Roles: usuarios normales pueden cambiar su propio rol
    Route::get('/role/edit', [RoleController::class, 'editOwnRole'])->name('role.edit-own');
    Route::put('/role/update', [RoleController::class, 'updateOwnRole'])->name('role.update-own');
    
    Route::resource('categorias', CategoriaController::class);

    // Rutas de usuario - Dashboard con búsqueda
    Route::get('/user/dashboard', [BookSearchController::class, 'searchUser'])->name('user.dashboard');

    // Admin books y dashboard
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [BookSearchController::class, 'searchAdmin'])->name('dashboard');
        
        Route::get('books', [BookController::class, 'index'])->name('books.index');
        Route::get('books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('books', [BookController::class, 'store'])->name('books.store');
        Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
        Route::get('books/{book}/download', [BookController::class, 'download'])->name('books.download');

        // Admin: gestionar roles de usuarios
        Route::get('roles/users', [RoleController::class, 'manageUsers'])->name('roles.manage-users');
        Route::put('roles/users/{user}', [RoleController::class, 'updateUserRole'])->name('role.update-user');
    });
});

require __DIR__.'/auth.php';