<x-app-layout>
    <x-slot name="header">
        <div class="text-center text-white bg-gradient-to-r from-indigo-500 to-purple-600 py-10 rounded-lg shadow-md">
            <h2 class="font-semibold text-3xl leading-tight mb-2 flex justify-center items-center gap-2">
                <i class="bi bi-speedometer2"></i> Dashboard
            </h2>
            <p class="opacity-90 text-lg">Panel principal de la Biblioteca Digital</p>
        </div>
    </x-slot>

    <main class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10 border border-gray-200">
                
                <!-- Bienvenida -->
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    👋 ¡Bienvenido, {{ auth()->user()->name }}!
                </h3>

                <!-- Rol actual -->
                <div class="mb-6">
                    <p class="text-lg text-gray-700">
                        <strong>Tu rol actual:</strong>
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded 
                            {{ optional(auth()->user()->rol)->nombre === 'admin' 
                                ? 'bg-red-500 text-white' 
                                : 'bg-blue-500 text-white' }}">
                            {{ optional(auth()->user()->rol)->nombre ?? 'No asignado' }}
                        </span>
                    </p>
                </div>

                <!-- Tarjetas principales -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    {{-- Cambiar Rol (solo usuario normal) --}}
                    @if(optional(auth()->user()->rol)->nombre === 'user')
                        <div class="bg-blue-50 p-6 rounded-lg shadow-sm hover:shadow-lg transition border border-blue-200">
                            <h4 class="font-bold text-blue-700 mb-2">
                                <i class="bi bi-person-gear"></i> Cambiar Mi Rol
                            </h4>
                            <p class="text-sm text-blue-700 mb-4">
                                Puedes cambiar tu rol entre usuario y administrador.
                            </p>
                            <a href="{{ route('role.edit-own') }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition">
                               Cambiar Rol
                            </a>
                        </div>
                    @endif

                    {{-- Panel Admin --}}
                    @if(optional(auth()->user()->rol)->nombre === 'admin')
                        <div class="bg-red-50 p-6 rounded-lg shadow-sm hover:shadow-lg transition border border-red-200">
                            <h4 class="font-bold text-red-800 mb-2">
                                <i class="bi bi-book-half"></i> Gestionar Libros
                            </h4>
                            <p class="text-sm text-red-700 mb-4">
                                Sube, edita y elimina libros en formato PDF.
                            </p>
                            <a href="{{ route('admin.books.index') }}" 
                               class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm transition">
                               Ir al Admin
                            </a>
                        </div>

                        <div class="bg-yellow-50 p-6 rounded-lg shadow-sm hover:shadow-lg transition border border-yellow-200">
                            <h4 class="font-bold text-yellow-800 mb-2">
                                <i class="bi bi-people"></i> Gestionar Usuarios
                            </h4>
                            <p class="text-sm text-yellow-700 mb-4">
                                Cambia roles y administra usuarios registrados.
                            </p>
                            <a href="{{ route('admin.roles.manage-users') }}" 
                               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm transition">
                               Gestionar Roles
                            </a>
                        </div>
                    @endif

                    {{-- Categorías --}}
                    <div class="bg-green-50 p-6 rounded-lg shadow-sm hover:shadow-lg transition border border-green-200">
                        <h4 class="font-bold text-green-800 mb-2">
                            <i class="bi bi-folder"></i> Categorías
                        </h4>
                        <p class="text-sm text-green-700 mb-4">
                            Consulta las categorías de libros disponibles.
                        </p>
                        <a href="{{ route('categorias.index') }}" 
                           class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm transition">
                           Ver Categorías
                        </a>
                    </div>

                    {{-- Perfil --}}
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-lg transition border border-gray-200">
                        <h4 class="font-bold text-gray-800 mb-2">
                            <i class="bi bi-person-circle"></i> Perfil
                        </h4>
                        <p class="text-sm text-gray-700 mb-4">
                            Edita tu información personal y cambia tu contraseña.
                        </p>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded text-sm transition">
                           Mi Perfil
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </main>
</x-app-layout>
