<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Procesa el registro de un usuario nuevo.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|confirmed|min:8',
        ]);

        // Por defecto asignamos rol_id = 2 (usuario normal)
        $user = User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'rol_id' => 2, // rol por defecto para usuarios nuevos
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }
}
