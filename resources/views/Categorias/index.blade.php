<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Listado de Categorías') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Categorías</h3>

                    <a href="{{ route('categorias.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Nueva Categoría
                    </a>

                    @if(session('success'))
                        <div class="mb-4 bg-green-600 text-white py-2 px-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full border border-gray-700 text-white">
                        <thead>
                            <tr class="bg-gray-900 text-white">
                                <th class="px-4 py-2 border border-gray-700">ID</th>
                                <th class="px-4 py-2 border border-gray-700">Nombre</th>
                                <th class="px-4 py-2 border border-gray-700">Descripción</th>
                                <th class="px-4 py-2 border border-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categorias as $categoria)
                                <tr class="hover:bg-gray-700">
                                    <td class="px-4 py-2 border border-gray-700">{{ $categoria->id }}</td>
                                    <td class="px-4 py-2 border border-gray-700">{{ $categoria->nombre }}</td>
                                    <td class="px-4 py-2 border border-gray-700">{{ $categoria->descripcion }}</td>
                                    <td class="px-4 py-2 border border-gray-700 space-x-2">
                                        <a href="{{ route('categorias.show', $categoria) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm font-semibold">
                                           Ver
                                        </a>
                                        <a href="{{ route('categorias.edit', $categoria) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-black py-1 px-3 rounded text-sm font-semibold">
                                           Editar
                                        </a>
                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-sm font-semibold"
                                                    onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-400">
                                        No hay categorías registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
