<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center gap-3">
            <i class="bi bi-people-fill text-2xl"></i>
            <div>
                <h2>Administración de Usuarios</h2>
                <p class="text-sm opacity-75 mt-1">Gestiona roles y permisos de usuarios</p>
            </div>
        </div>
    </x-slot>

    <!-- Mensaje de éxito -->
    @if ($message = Session::get('success'))
        <x-alert-success :message="$message" />
    @endif

    <!-- Contenido -->
    @if($users->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Tabla de usuarios mejorada -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                <i class="bi bi-hash mr-2"></i>ID
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                <i class="bi bi-person mr-2"></i>Nombre
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                <i class="bi bi-envelope mr-2"></i>Email
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                <i class="bi bi-shield-check mr-2"></i>Rol Actual
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                <i class="bi bi-tools mr-2"></i>Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                        {{ $user->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="font-semibold text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    @if(optional($user->rol)->nombre === 'admin')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                            <i class="bi bi-shield-lock mr-1"></i>{{ optional($user->rol)->nombre ?? 'Sin rol' }}
                                        </span>
                                    @elseif(optional($user->rol)->nombre === 'usuario')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                            <i class="bi bi-person-check mr-1"></i>{{ optional($user->rol)->nombre ?? 'Sin rol' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                            <i class="bi bi-dash mr-1"></i>Sin rol
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.role.update-user', $user) }}" method="POST" class="flex gap-2 items-center justify-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="rol_id" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm font-medium">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->rol_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 transition font-medium text-sm">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $users->links('pagination::simple-bootstrap-5') }}
                </div>
            @endif
        </div>
    @else
        <!-- Estado vacío -->
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="bi bi-people text-gray-400 text-5xl mb-4 block"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">No hay usuarios registrados</h3>
            <p class="text-gray-500">Actualmente no hay usuarios en el sistema para gestionar.</p>
        </div>
    @endif
</x-app-layout>
