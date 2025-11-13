<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('user.books.search') }}" class="text-indigo-600 hover:text-indigo-700">
                    <i class="bi bi-arrow-left text-2xl"></i>
                </a>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800">Detalles del Libro</h2>
                    <p class="text-sm opacity-75 mt-1">Información completa y descarga</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Card principal -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="grid md:grid-cols-3 gap-8 p-8">
                    <!-- Portada del libro -->
                    <div>
                        <div class="bg-gradient-to-br from-indigo-400 to-purple-500 rounded-lg h-80 flex items-center justify-center relative overflow-hidden sticky top-8">
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-6 text-center">
                                <i class="bi bi-book text-7xl opacity-30 mb-4"></i>
                                <p class="text-xs font-semibold opacity-75 uppercase">{{ $book->category->nombre ?? 'Sin categoría' }}</p>
                            </div>
                        </div>

                        <!-- Botón de descarga grande -->
                        <a href="{{ route('user.books.download', $book) }}" class="w-full mt-6 px-6 py-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-bold text-center block">
                            <i class="bi bi-download"></i> Descargar PDF
                        </a>
                    </div>

                    <!-- Información del libro -->
                    <div class="md:col-span-2">
                        <!-- Título -->
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">
                            {{ $book->title }}
                        </h1>

                        <!-- Autor -->
                        <p class="text-xl text-gray-600 mb-6">
                            <i class="bi bi-person"></i> {{ $book->author }}
                        </p>

                        <!-- Categoría -->
                        <div class="mb-6">
                            <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full font-semibold">
                                {{ $book->category->nombre ?? 'Sin categoría' }}
                            </span>
                        </div>

                        <!-- Información adicional -->
                        <div class="grid grid-cols-3 gap-4 mb-8 p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-gray-600 text-sm">Vistas</p>
                                <p class="text-2xl font-bold text-indigo-600">
                                    <i class="bi bi-eye"></i> {{ $book->views }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Estado</p>
                                <p class="text-2xl font-bold text-green-600">
                                    <i class="bi bi-check-circle"></i> Disponible
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Publicado</p>
                                <p class="text-lg font-bold text-gray-800">
                                    {{ $book->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- ISBN -->
                        @if($book->isbn)
                            <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <p class="text-sm text-gray-600">ISBN</p>
                                <p class="text-lg font-mono font-bold text-blue-900">{{ $book->isbn }}</p>
                            </div>
                        @endif

                        <!-- Descripción -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Descripción</h3>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                                {{ $book->description ?? 'Sin descripción disponible' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Libros relacionados -->
            @if($relatedBooks->count() > 0)
                <div class="mt-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">
                        <i class="bi bi-collection"></i> Libros Relacionados
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedBooks as $related)
                            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition transform hover:scale-105 overflow-hidden">
                                <!-- Preview -->
                                <div class="bg-gradient-to-br from-indigo-400 to-purple-500 h-32 flex items-center justify-center">
                                    <i class="bi bi-book text-5xl text-white opacity-30"></i>
                                </div>

                                <!-- Contenido -->
                                <div class="p-4">
                                    <h3 class="text-sm font-bold text-gray-800 line-clamp-2 mb-1">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-xs text-gray-600 mb-3">{{ $related->author }}</p>
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ route('user.books.show', $related) }}" class="flex-1 px-2 py-1 bg-indigo-600 text-white rounded text-center text-xs font-semibold hover:bg-indigo-700">
                                            Ver
                                        </a>
                                        <a href="{{ route('user.books.download', $related) }}" class="flex-1 px-2 py-1 bg-green-600 text-white rounded text-center text-xs font-semibold hover:bg-green-700">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Botón de regreso -->
            <div class="mt-8 text-center">
                <a href="{{ route('user.books.search') }}" class="inline-block px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-semibold">
                    <i class="bi bi-arrow-left"></i> Volver a la búsqueda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
