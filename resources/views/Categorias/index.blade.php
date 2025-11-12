<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Listado de Categorías') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-md sm:rounded-lg p-6 text-white">
                
                @if (session('success'))
                    <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Categorías registradas</h3>
                    <a href="{{ route('categorias.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition duration-200">
                        + Nueva Categoría
                    </a>
                </div>

                <table class="min-w-full border border-gray-700 rounded-lg overflow-hidden">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Descripción</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr class="border-t border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $categoria->id }}</td>
                                <td class="px-4 py-2">{{ $categoria->nombre }}</td>
                                <td class="px-4 py-2">{{ $categoria->descripcion }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('categorias.show', $categoria) }}" 
                                       class="text-blue-400 hover:text-blue-300 mr-2">Ver</a>
                                    <a href="{{ route('categorias.edit', $categoria) }}" 
                                       class="text-yellow-400 hover:text-yellow-300 mr-2">Editar</a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            onclick="return confirm('¿Deseas eliminar esta categoría?')" 
                                            class="text-red-500 hover:text-red-300">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-400">
                                    No hay categorías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
