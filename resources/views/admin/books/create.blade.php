<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center gap-3">
            <i class="bi bi-plus-circle text-2xl"></i>
            <div>
                <h2 class="font-semibold text-xl text-gray-800">Subir Nuevo Libro</h2>
                <p class="text-sm opacity-75 mt-1">Agrega un nuevo libro a tu biblioteca digital</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10">
        <!-- Encabezado -->
        <div class="mb-8 flex items-center gap-2">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 flex items-center justify-center">
                <i class="bi bi-plus-lg text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Crear Nuevo Libro</h1>
                <p class="text-gray-500 text-sm">Completa el formulario para agregar un libro (PDF)</p>
            </div>
        </div>

        <!--errores -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                <strong class="block mb-2">Por favor revisa los siguientes errores:</strong>
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Consejo -->
        <div class="mb-6 p-4 rounded-lg bg-amber-50 border border-amber-200 flex items-start gap-3">
            <i class="bi bi-lightbulb text-amber-600 text-xl mt-0.5 flex-shrink-0"></i>
            <div class="text-amber-800">
                <p class="text-sm font-semibold">Consejo: Asegúrate de que tu PDF sea válido</p>
                <p class="text-xs opacity-75">El archivo debe ser PDF válido con un tamaño máximo de 20 MB.</p>
            </div>
        </div>

        <!-- Formulario -->
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Título -->
            <x-form-input
                name="title"
                label="Título del Libro"
                placeholder="Ej: El Quijote de la Mancha"
                required
            />

            <!-- Autor -->
            <x-form-input
                name="author"
                label="Autor"
                placeholder="Ej: Miguel de Cervantes"
                required
            />

            <!-- ISBN -->
            <x-form-input
                name="isbn"
                label="ISBN"
                placeholder="Ej: 978-3-16-148410-0"
            />

            <!-- Descripción -->
            <x-form-textarea
                name="description"
                label="Descripción"
                placeholder="Escribe una descripción detallada sobre el contenido del libro..."
                rows="5"
            />

            <!-- Categoría -->
            <x-form-select
                name="category_id"
                label="Categoría"
                :options="$categorias->pluck('nombre', 'id')->toArray()"
                placeholder="-- Selecciona una categoría --"
            />

            <!-- Subir archivo -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-semibold text-gray-700 mb-2">
                    Archivo PDF <span class="text-red-500">*</span>
                </label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 transition duration-200 hover:border-indigo-500 hover:bg-indigo-50 cursor-pointer bg-gray-50" onclick="document.getElementById('file').click()">
                    <input
                        type="file"
                        name="file"
                        id="file"
                        accept="application/pdf"
                        required
                        class="hidden"
                        onchange="document.querySelector('.file-name').textContent = this.files[0].name"
                    />
                    <div class="text-center">
                        <i class="bi bi-cloud-upload text-indigo-500 text-3xl mb-2 block"></i>
                        <p class="font-semibold text-gray-700">Haz clic para seleccionar un archivo</p>
                        <p class="text-xs text-gray-500 mt-1">o arrastra y suelta tu archivo aquí</p>
                        <p class="text-xs text-gray-400 mt-2 file-name">Ningún archivo seleccionado</p>
                    </div>
                </div>
                <p class="mt-2 text-xs text-gray-600 flex items-center gap-1">
                    <i class="bi bi-info-circle"></i>
                    Máximo 20 MB. Solo archivos PDF.
                </p>
                @error('file')
                    <div class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <!-- Botón Cancelar -->
                <a href="{{ route('admin.books.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 flex items-center gap-2 transition">
                    <i class="bi bi-arrow-left"></i>
                    Cancelar
                </a>

                <!-- Botón Guardar -->
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2 transition">
                    <i class="bi bi-cloud-upload"></i>
                    Guardar Libro
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
