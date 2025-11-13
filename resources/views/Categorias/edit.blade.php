<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Categoría') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-900 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-md sm:rounded-lg p-6 text-white">
                
                @if ($errors->any())
                    <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">
                        <strong>Error:</strong> Revisa los campos marcados.
                    </div>
                @endif

                <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-white font-semibold mb-2">Nombre</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            value="{{ old('nombre', $categoria->nombre) }}" 
                            class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:ring focus:ring-blue-500" 
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-white font-semibold mb-2">Descripción</label>
                        <textarea 
                            name="descripcion" 
                            class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:ring focus:ring-blue-500">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button 
                            type="submit" 
                            class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-4 py-2 rounded transition duration-200">
                            Actualizar
                        </button>

                        <a href="{{ route('categorias.index') }}" 
                           class="text-gray-400 hover:text-white transition duration-200">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
