<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de Categoría') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-bold mb-4">Información de la categoría</h3>

                    <div class="mb-4">
                        <strong>ID:</strong> {{ $categoria->id }}
                    </div>

                    <div class="mb-4">
                        <strong>Nombre:</strong> {{ $categoria->nombre }}
                    </div>

                    <div class="mb-4">
                        <strong>Descripción:</strong> {{ $categoria->descripcion ?? 'Sin descripción' }}
                    </div>

                    <div class="mb-4">
                        <strong>Creado el:</strong> {{ $categoria->created_at ? $categoria->created_at->format('d/m/Y H:i') : 'N/A' }}
                    </div>

                    <div class="mb-6">
                        <strong>Última actualización:</strong> {{ $categoria->updated_at ? $categoria->updated_at->format('d/m/Y H:i') : 'N/A' }}
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('categorias.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Volver</a>
                        <a href="{{ route('categorias.edit', $categoria) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Editar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
