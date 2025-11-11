<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use App\Models\Role;

class AssignDefaultRole
{
    /**
     * Handle the event.
     */
    /**
     * Handle the event. Accept Registered and Login events.
     * The events cache may have this listener attached to Login as well,
     * so accept a generic event and guard the type.
     *
     * @param  mixed  $event
     */
    public function handle($event): void
    {
        try {
            // Determine user from Registered or Login event
            if ($event instanceof Registered || $event instanceof Login) {
                $user = $event->user;
            } else {
                return; // nothing to do for other event types
            }
            
            // Si el usuario no tiene rol asignado, asigna "user"
            if (!$user->rol_id) {
                $userRole = Role::where('nombre', 'user')->first();
                if ($userRole) {
                    $user->rol_id = $userRole->id;
                    $user->save();
                }
            }
        } catch (\Exception $e) {
            // Silenciar errores para no interrumpir el flujo de registro
            return;
        }
    }
}
