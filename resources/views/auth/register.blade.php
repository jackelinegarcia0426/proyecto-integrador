@extends('layouts.app')

@section('content')
<div class="auth-wrap">
    <div class="auth-card animate-fade-up delay-100">
        <h2 class="auth-title">Crear cuenta</h2>

        @if($errors->any())
            <div class="auth-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('register') }}" class="auth-form">
            @csrf

            <label class="field">
                <span>Nombre</span>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required class="input" />
            </label>

            <label class="field">
                <span>Correo</span>
                <input type="email" name="correo" value="{{ old('correo') }}" required class="input" />
            </label>

            <label class="field">
                <span>Contraseña</span>
                <input type="password" name="contrasena" required class="input" />
            </label>

            <label class="field">
                <span>Confirmar contraseña</span>
                <input type="password" name="contrasena_confirmation" required class="input" />
            </label>

            <div class="mt-4">
                <button type="submit" class="btn">Registrarme</button>
            </div>
        </form>
    </div>
</div>
@endsection
