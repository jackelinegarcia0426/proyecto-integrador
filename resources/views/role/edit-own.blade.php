@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Cambiar Mi Rol</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p><strong>Usuario:</strong> {{ $user->name }}</p>
            <p><strong>Rol actual:</strong> {{ optional($user->rol)->nombre ?? 'No asignado' }}</p>

            <form action="{{ route('role.update-own') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="rol_id" class="form-label">Selecciona un nuevo rol</label>
                    <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror" required>
                        <option value="">-- Selecciona un rol --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->rol_id == $role->id ? 'selected' : '' }}>
                                {{ $role->nombre }} ({{ $role->descripcion }})
                            </option>
                        @endforeach
                    </select>
                    @error('rol_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cambiar Rol</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
