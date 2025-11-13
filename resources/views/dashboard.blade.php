<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center gap-3">
            <i class="bi bi-speedometer2 text-2xl"></i>
            <div>
                <h2>Dashboard</h2>
                <p class="text-sm opacity-75 mt-1">Panel principal de la Biblioteca Digital</p>
            </div>
        </div>
    </x-slot>

    <!-- Bienvenida -->
    <div class="mb-8 p-6 rounded-lg bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-200">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">👋 ¡Bienvenido, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-600 mt-2">
                    Rol actual: 
                    <span class="inline-block px-4 py-1.5 text-sm font-semibold rounded-full 
                        {{ optional(auth()->user()->rol)->nombre === 'admin' 
                            ? 'bg-red-100 text-red-700' 
                            : 'bg-blue-100 text-blue-700' }}">
                        <i class="bi mr-1"></i>
                        {{ optional(auth()->user()->rol)->nombre ?? 'No asignado' }}
                    </span>
                </p>
            </div>
            <i class="bi bi-person-circle text-6xl text-indigo-300 opacity-50"></i>
        </div>
    </div>

    <!-- Grid de tarjetas principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Cambiar Rol (solo usuario normal) --}}
        @if(optional(auth()->user()->rol)->nombre === 'user' || optional(auth()->user()->rol)->nombre === 'usuario')
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-l-4 border-blue-500">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                                <i class="bi bi-person-gear text-blue-600 text-xl"></i>
                                Cambiar Mi Rol
                            </h3>
                        </div>
                        <i class="bi bi-arrow-right-circle text-blue-300 text-2xl"></i>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Puedes cambiar tu rol entre usuario y administrador para acceder a más funciones.
                    </p>
                    <a href="{{ route('role.edit-own') }}" 
                       class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm transition transform hover:scale-105">
                       <i class="bi bi-arrow-right mr-1"></i>
                       Cambiar Rol
                    </a>
                </div>
            </div>
        @endif

        {{-- Gestionar Libros (Admin) --}}
        @if(optional(auth()->user()->rol)->nombre === 'admin')
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-l-4 border-red-500">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                                <i class="bi bi-book-half text-red-600 text-xl"></i>
                                Gestionar Libros
                            </h3>
                        </div>
                        <i class="bi bi-arrow-right-circle text-red-300 text-2xl"></i>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Sube, edita, descarga y elimina libros en formato PDF de tu biblioteca.
                    </p>
                    <a href="{{ route('admin.books.index') }}" 
                       class="inline-flex items-center px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm transition transform hover:scale-105">
                       <i class="bi bi-arrow-right mr-1"></i>
                       Panel de Libros
                    </a>
                </div>
            </div>

            {{-- Gestionar Usuarios (Admin) --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-l-4 border-amber-500">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                                <i class="bi bi-people text-amber-600 text-xl"></i>
                                Gestionar Usuarios
                            </h3>
                        </div>
                        <i class="bi bi-arrow-right-circle text-amber-300 text-2xl"></i>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Administra usuarios, cambia sus roles y gestiona permisos.
                    </p>
                    <a href="{{ route('admin.roles.manage-users') }}" 
                       class="inline-flex items-center px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm transition transform hover:scale-105">
                       <i class="bi bi-arrow-right mr-1"></i>
                       Gestionar Roles
                    </a>
                </div>
            </div>
        @endif

        {{-- Categorías --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-l-4 border-green-500">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="bi bi-folder text-green-600 text-xl"></i>
                            Categorías
                        </h3>
                    </div>
                    <i class="bi bi-arrow-right-circle text-green-300 text-2xl"></i>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    Explora y consulta las categorías de libros disponibles en tu biblioteca.
                </p>
                <a href="{{ route('categorias.index') }}" 
                   class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold text-sm transition transform hover:scale-105">
                   <i class="bi bi-arrow-right mr-1"></i>
                   Ver Categorías
                </a>
            </div>
        </div>

        {{-- Mi Perfil --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-l-4 border-purple-500">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="bi bi-person-circle text-purple-600 text-xl"></i>
                            Mi Perfil
                        </h3>
                    </div>
                    <i class="bi bi-arrow-right-circle text-purple-300 text-2xl"></i>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    Edita tu información personal y cambia tu contraseña de forma segura.
                </p>
                <a href="{{ route('profile.edit') }}" 
                   class="inline-flex items-center px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-700 text-white font-semibold text-sm transition transform hover:scale-105">
                   <i class="bi bi-arrow-right mr-1"></i>
                   Editar Perfil
                </a>
            </div>
        </div>

        {{-- Información Rápida --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-l-4 border-indigo-500">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="bi bi-info-circle text-indigo-600 text-xl"></i>
                            Información
                        </h3>
                    </div>
                    <i class="bi bi-arrow-right-circle text-indigo-300 text-2xl"></i>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    <strong>Email:</strong> {{ auth()->user()->email }}<br>
                    <strong>Miembro desde:</strong> {{ auth()->user()->created_at->format('d/m/Y') }}
                </p>
                <div class="text-xs text-gray-500 bg-gray-50 p-3 rounded">
                    Última actividad: {{ auth()->user()->updated_at->diffForHumans() }}
                </div>
            </div>
        </div>

    </div>

    <!-- Sección de ayuda -->
    <div class="mt-8 p-6 rounded-lg bg-blue-50 border border-blue-200">
        <div class="flex items-start gap-4">
            <i class="bi bi-question-circle text-blue-600 text-2xl mt-0.5 flex-shrink-0"></i>
            <div>
                <h3 class="font-bold text-blue-900 mb-2">¿Necesitas ayuda?</h3>
                <p class="text-sm text-blue-800">
                    Explora tu biblioteca digital, administra tus libros y mantente organizado. 
                    Si tienes preguntas o necesitas soporte, no dudes en contactar con el administrador.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
