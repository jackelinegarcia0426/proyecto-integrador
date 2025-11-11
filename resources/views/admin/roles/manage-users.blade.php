<x-app-layout>
    <x-slot name="header">
        <div class="text-center text-white bg-gradient-to-r from-indigo-500 to-purple-600 py-10 rounded-lg shadow-md">
            <h2 class="font-semibold text-3xl leading-tight mb-2 flex justify-center items-center gap-2">
                <i class="bi bi-people-fill"></i> Administración de Usuarios
            </h2>
            <p class="opacity-90 text-lg">Gestiona roles y permisos</p>
        </div>
    </x-slot>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    :root { --form-element-invalid-border-color: #d32f2f; --muted-color: #6c757d; }
    main { background: #f8f9fa; }
    .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem 0; margin-bottom: 2rem; border-radius: 0; }
    .hero h1 { margin-bottom: 0.5rem; font-size: 2rem; }
    .hero p { margin: 0; opacity: 0.95; }
    .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .stat-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
    .stat-card strong { display: block; font-size: 2rem; color: #667eea; margin-bottom: 0.5rem; }
    .stat-card small { color: #999; }
    table { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    table thead { background: #f8f9fa; border-bottom: 2px solid #e0e0e0; }
    table tbody tr { border-bottom: 1px solid #f0f0f0; transition: background 0.2s; }
    table tbody tr:hover { background: #f9f9f9; }
    .btn-group { display: flex; gap: 0.5rem; justify-content: center; align-items: center; }
    .btn { border-radius: 4px; transition: all 0.3s; padding: 0.5rem 1rem; border: none; cursor: pointer; font-size: 0.9rem; }
    .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.85rem; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
    .btn-primary { background: #667eea; color: white; }
    .btn-primary:hover { background: #5568d3; }
    .btn-success { background: #28a745; color: white; }
    .btn-warning { background: #ffc107; color: white; }
    .btn-info { background: #17a2b8; color: white; }
    .btn-danger { background: #dc3545; color: white; }
    .badge { padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.85rem; display: inline-block; }
    .empty-state { text-align: center; padding: 3rem; color: #999; }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }
    .actions-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; gap: 1rem; flex-wrap: wrap; }
    .actions-section > div { display: flex; gap: 1rem; flex-wrap: wrap; }
    .success-message { background: #d4edda; border-left: 4px solid #28a745; padding: 1rem; margin-bottom: 1rem; border-radius: 4px; }
    .success-message strong { color: #155724; }
    .role-selector { display: flex; gap: 0.5rem; align-items: center; }
    .role-selector select { padding: 0.4rem 0.6rem; font-size: 0.9rem; border: 1px solid #ddd; border-radius: 4px; }
</style>

    <main>
        <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
            
            @if ($message = Session::get('success'))
                <article style="background: #d4edda; border-left: 4px solid #28a745; margin-bottom: 1rem;">
                    <strong>✓ Éxito:</strong> {{ $message }}
                </article>
            @endif

            @if($users->count() > 0)
                <div style="overflow-x: auto;">
                    <table>
                    <thead>
                        <tr style="background: #f8f9fa;">
                            <th><i class="bi bi-hash"></i> ID</th>
                            <th><i class="bi bi-person"></i> Nombre</th>
                            <th><i class="bi bi-envelope"></i> Email</th>
                            <th><i class="bi bi-shield-check"></i> Rol Actual</th>
                            <th style="text-align: center;"><i class="bi bi-tools"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <span class="badge" style="background: #667eea; color: white;">{{ $user->id }}</span>
                                </td>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                </td>
                                <td>
                                    <small>{{ $user->email }}</small>
                                </td>
                                <td>
                                    @if(optional($user->rol)->nombre === 'admin')
                                        <span class="badge" style="background: #f5576c; color: white;">
                                            {{ optional($user->rol)->nombre ?? 'Sin rol' }}
                                        </span>
                                    @else
                                        <span class="badge" style="background: #17a2b8; color: white;">
                                            {{ optional($user->rol)->nombre ?? 'Sin rol' }}
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('admin.role.update-user', $user) }}" method="POST" style="display: inline; margin: 0;">
                                        @csrf
                                        @method('PUT')
                                        <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                            <select name="rol_id" class="role-select" style="padding: 0.4rem 0.6rem; font-size: 0.9rem; border: 1px solid #ddd; border-radius: 4px;">
                                                <option value="">-- Seleccionar --</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $user->rol_id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm" style="background: #667eea; color: white; padding: 0.4rem 1rem;">
                                                <i class="bi bi-check2"></i> Guardar
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div style="margin-top: 2rem; text-align: center;">
                        {{ $users->links('pagination::simple-bootstrap-5') }}
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 3rem; color: #999;">
                    <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
                    <p><strong>No hay usuarios registrados</strong></p>
                </div>
            @endif

        </div>
    </main>
</x-app-layout>
