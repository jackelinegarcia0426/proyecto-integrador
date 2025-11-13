<!-- 
EJEMPLO DE NUEVA VISTA USANDO EL NUEVO DISEÑO
Este archivo muestra cómo crear una nueva vista manteniendo la consistencia visual.
Copia y adapta este código para tus nuevas páginas.
-->

<x-app-layout>
    <!-- Encabezado de la página -->
    <x-slot name="header">
        <div class="flex items-center justify-center gap-3">
            <i class="bi bi-icon-aqui text-2xl"></i>
            <div>
                <h2>Título de la Página</h2>
                <p class="text-sm opacity-75 mt-1">Descripción corta de esta página</p>
            </div>
        </div>
    </x-slot>

    <!-- Contenido principal: máximo 2xl de ancho, centrado -->
    <div class="max-w-2xl mx-auto">
        
        <!-- ========== MENSAJES DE SESIÓN ========== -->
        
        <!-- Mensaje de éxito -->
        @if ($message = Session::get('success'))
            <x-alert-success :message="$message" />
        @endif

        <!-- Mensaje de error general -->
        @if ($message = Session::get('error'))
            <x-alert-error :message="$message" />
        @endif

        <!-- Mensaje de información -->
        @if ($message = Session::get('info'))
            <x-alert-info :message="$message" />
        @endif

        <!-- Errores de validación -->
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

        <!-- ========== ENCABEZADO DE SECCIÓN ========== -->
        
        <div class="mb-8 flex items-center gap-2">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                <i class="bi bi-icon-aqui text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Título Principal</h1>
                <p class="text-gray-500 text-sm">Descripción más detallada</p>
            </div>
        </div>

        <!-- ========== FORMULARIO ========== -->
        
        <form action="{{ route('route.name') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Input de texto -->
            <x-form-input
                name="nombre"
                label="Nombre"
                placeholder="Ingresa el nombre"
                value="{{ old('nombre') }}"
                required
            />

            <!-- Input de email -->
            <x-form-input
                name="email"
                label="Correo Electrónico"
                type="email"
                placeholder="tu@email.com"
                value="{{ old('email') }}"
                required
            />

            <!-- Textarea -->
            <x-form-textarea
                name="descripcion"
                label="Descripción"
                placeholder="Escribe una descripción detallada..."
                rows="5"
                value="{{ old('descripcion') }}"
            />

            <!-- Select -->
            <x-form-select
                name="categoria"
                label="Categoría"
                :options="['opcion1' => 'Opción 1', 'opcion2' => 'Opción 2']"
                value="{{ old('categoria') }}"
                placeholder="-- Selecciona una opción --"
                required
            />

            <!-- Upload de archivo -->
            <div class="mb-6">
                <label for="archivo" class="block text-sm font-semibold text-gray-700 mb-2">
                    Archivo (opcional)
                </label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 transition duration-200 hover:border-indigo-500 hover:bg-indigo-50 cursor-pointer bg-gray-50">
                    <input
                        type="file"
                        name="archivo"
                        id="archivo"
                        class="hidden"
                        onchange="document.querySelector('.file-name').textContent = this.files[0].name"
                    />
                    <div class="text-center">
                        <i class="bi bi-cloud-upload text-indigo-500 text-3xl mb-2 block"></i>
                        <p class="font-semibold text-gray-700">Haz clic para seleccionar</p>
                        <p class="text-xs text-gray-500 mt-1">o arrastra y suelta aquí</p>
                        <p class="text-xs text-gray-400 mt-2 file-name">Ningún archivo seleccionado</p>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <x-btn-secondary href="{{ route('back') }}">
                    <i class="bi bi-arrow-left"></i>
                    Cancelar
                </x-btn-secondary>
                <x-btn-primary>
                    <i class="bi bi-check-circle"></i>
                    Guardar
                </x-btn-primary>
            </div>
        </form>

        <!-- ========== TABLA DE DATOS ========== -->
        
        <!-- Nota: Este ejemplo se usa cuando necesitas mostrar una lista -->
        
        @if($items->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mt-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    <i class="bi bi-hash mr-2"></i>ID
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    <i class="bi bi-tag mr-2"></i>Nombre
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                    <i class="bi bi-tools mr-2"></i>Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                            {{ $item->id }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        {{ $item->nombre }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <!-- Ver/Descargar -->
                                            <a href="{{ route('items.show', $item) }}" 
                                               class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition font-medium text-sm"
                                               title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Editar -->
                                            <a href="{{ route('items.edit', $item) }}" 
                                               class="inline-flex items-center px-3 py-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition font-medium text-sm"
                                               title="Editar">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Eliminar -->
                                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition font-medium text-sm"
                                                        title="Eliminar"
                                                        onclick="return confirm('¿Estás seguro?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($items->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $items->links('pagination::simple-bootstrap-5') }}
                    </div>
                @endif
            </div>
        @else
            <!-- Estado vacío -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center mt-8">
                <i class="bi bi-inbox text-gray-400 text-5xl mb-4 block"></i>
                <h3 class="text-xl font-bold text-gray-700 mb-2">No hay registros</h3>
                <p class="text-gray-500 mb-6">Actualmente no hay elementos para mostrar.</p>
                <x-btn-primary href="{{ route('items.create') }}">
                    <i class="bi bi-plus-circle"></i>
                    Crear Nuevo
                </x-btn-primary>
            </div>
        @endif

    </div>
</x-app-layout>

<!--
NOTAS IMPORTANTES:

1. ESTRUCTURA BÁSICA:
   - Usa siempre <x-app-layout> como contenedor
   - Define el header con <x-slot name="header">
   - Envuelve el contenido en <div class="max-w-2xl mx-auto">

2. COMPONENTES DISPONIBLES:
   - <x-form-input> - Inputs de texto
   - <x-form-textarea> - Áreas de texto
   - <x-form-select> - Selectores
   - <x-alert-success> - Mensajes de éxito
   - <x-alert-error> - Mensajes de error
   - <x-alert-info> - Mensajes de información
   - <x-btn-primary> - Botones principales
   - <x-btn-secondary> - Botones secundarios
   - <x-btn-danger> - Botones de eliminación
   - <x-btn-success> - Botones de éxito

3. ÍCONES:
   - Usa Bootstrap Icons: <i class="bi bi-nombre-icono"></i>
   - Lista completa: https://icons.getbootstrap.com/

4. COLORES TAILWIND:
   - Primario: indigo-600, indigo-500
   - Secundario: purple-600, purple-500
   - Éxito: green-600
   - Peligro: red-600
   - Advertencia: amber-600
   - Información: blue-600

5. ESPACIADO:
   - Usa clases: mb-6, px-4, gap-3, etc.
   - Sigue la escala de Tailwind: 2, 4, 6, 8, 10, 12, 16, 20, 24...

6. RESPONSIVE:
   - Usa: md:, lg:, xl: para breakpoints
   - Ejemplo: <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

¡Mantén la consistencia usando estos componentes! 🎨
-->
