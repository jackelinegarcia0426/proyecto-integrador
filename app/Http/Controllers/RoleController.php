<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Vista para cambiar rol del usuario actual (solo "user" puede cambiar)
     */
    public function editOwnRole()
    {
        $user = Auth::user();
        
        // Permitir solo si el usuario tiene rol "user"
        if (!optional($user->rol)->nombre || optional($user->rol)->nombre !== 'user') {
            abort(403, 'Solo usuarios normales pueden cambiar de rol');
        }

        $roles = Role::all();
        return view('role.edit-own', compact('user', 'roles'));
    }

    /**
     * Actualizar rol del usuario actual
     */
    public function updateOwnRole(Request $request)
    {
        $user = Auth::user();

        // Permitir solo si el usuario tiene rol "user"
        if (!optional($user->rol)->nombre || optional($user->rol)->nombre !== 'user') {
            abort(403, 'Solo usuarios normales pueden cambiar de rol');
        }

        $data = $request->validate([
            'rol_id' => 'required|exists:roles,id',
        ]);

        $user->update(['rol_id' => $data['rol_id']]);

        return redirect()->back()->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Vista para admins: listar todos los usuarios y sus roles
     */
    public function manageUsers()
    {
        $users = User::with('rol')->paginate(20);
        $roles = Role::all();

        return view('admin.roles.manage-users', compact('users', 'roles'));
    }

    /**
     * Admin actualiza el rol de un usuario
     */
    public function updateUserRole(Request $request, User $user)
    {
        $data = $request->validate([
            'rol_id' => 'required|exists:roles,id',
        ]);

        $user->update(['rol_id' => $data['rol_id']]);

        return redirect()->back()->with('success', "Rol del usuario {$user->name} actualizado correctamente");
    }
}
