<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/book/{book}/favorite', [FavoriteController::class, 'toggle']);
});
