<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center gap-3">
            <i class="bi bi-pencil-square text-2xl"></i>
            <div>
                <h2>Editar Libro</h2>
                <p class="text-sm opacity-75 mt-1">Actualiza la información del libro seleccionado</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <!-- Encabezado con ícono -->
        <div class="mb-8 flex items-center gap-2">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                <i class="bi bi-book text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $book->title }}</h1>
                <p class="text-gray-500 text-sm">Modificar datos del libro</p>
            </div>
        </div>

        <!-- Mostrar errores generales si existen -->
        @if ($errors->any())
            <x-alert-error>
                <strong class="block mb-2">¡Por favor revisa los siguientes errores:</strong>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert-error>
        @endif

        <!-- Formulario -->
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Título -->
            <x-form-input
                name="title"
                label="Título del Libro"
                placeholder="Ingresa el título del libro"
                value="{{ $book->title }}"
                required
            />

            <!-- Autor -->
            <x-form-input
                name="author"
                label="Autor"
                placeholder="Ingresa el nombre del autor"
                value="{{ $book->author }}"
                required
            />

            <!-- ISBN -->
            <x-form-input
                name="isbn"
                label="ISBN"
                placeholder="Ingresa el ISBN del libro"
                value="{{ $book->isbn }}"
            />

            <!-- Descripción -->
            <x-form-textarea
                name="description"
                label="Descripción"
                placeholder="Escribe una descripción detallada del libro"
                value="{{ $book->description }}"
                rows="5"
            />

            <!-- Categoría -->
            <x-form-select
                name="category_id"
                label="Categoría"
                :options="$categorias->pluck('nombre', 'id')->toArray()"
                value="{{ $book->category_id }}"
                placeholder="-- Selecciona una categoría --"
            />

            <!-- Upload de archivo -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-semibold text-gray-700 mb-2">
                    Reemplazar archivo PDF (opcional)
                </label>
                <div class="relative">
                    <input
                        type="file"
                        name="file"
                        id="file"
                        accept="application/pdf"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 text-gray-700 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200"
                    />
                </div>
                <p class="mt-2 text-xs text-gray-600 flex items-center gap-1">
                    <i class="bi bi-info-circle"></i>
                    Máximo 20 MB. Solo archivos PDF. Dejar vacío para mantener el PDF actual.
                </p>
                @error('file')
                    <div class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Información actual del archivo -->
            @if($book->file_path)
                <div class="p-4 rounded-lg bg-blue-50 border border-blue-200 mb-6">
                    <div class="flex items-center gap-2 text-blue-800">
                        <i class="bi bi-file-pdf text-blue-600"></i>
                        <div>
                            <p class="text-sm font-semibold">Archivo actual</p>
                            <p class="text-xs opacity-75">{{ basename($book->file_path) }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Botones de acción -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <x-btn-secondary href="{{ route('admin.books.index') }}">
                    <i class="bi bi-arrow-left"></i>
                    Cancelar
                </x-btn-secondary>
                <x-btn-primary>
                    <i class="bi bi-check-circle"></i>
                    Guardar Cambios
                </x-btn-primary>
            </div>
        </form>
    </div>
</x-app-layout>
