<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Listeners\AssignDefaultRole;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Asignar rol "user" automáticamente al registro
        $this->app['events']->listen(Registered::class, AssignDefaultRole::class);
    }
}
