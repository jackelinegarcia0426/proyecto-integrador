@extends('layouts.app')

@section('content')
<div class="auth-wrap">
    <div class="auth-card animate-fade-up">
        <h2 class="auth-title">Iniciar sesión</h2>

        @if($errors->any())
            <div class="auth-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('login') }}" class="auth-form">
            @csrf

            <label class="field">
                <span>Correo</span>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="input" />
            </label>

            <label class="field">
                <span>Contraseña</span>
                <input type="password" name="password" required class="input" />
            </label>

            <label class="flex items-center gap-2 text-sm mt-2">
                <input type="checkbox" name="remember" /> <span>Recordarme</span>
            </label>

            <div class="mt-4 flex gap-3 items-center">
                <button type="submit" class="btn">Entrar</button>
                <a href="{{ route('register') }}" class="btn-secondary">Crear cuenta</a>
            </div>
        </form>
    </div>
</div>
@endsection
