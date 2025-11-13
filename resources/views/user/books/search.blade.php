<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-center gap-3">
                <i class="bi bi-search text-2xl text-indigo-600"></i>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800">Biblioteca de Libros</h2>
                    <p class="text-sm opacity-75 mt-1">Busca y descubre libros interesantes</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Panel de Búsqueda -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-gradient-to-r from-indigo-500 to-purple-600">
                    <!-- Barra de búsqueda principal -->
                    <form action="{{ route('user.books.search') }}" method="GET" class="mb-6">
                        <div class="flex gap-2">
                            <div class="flex-1 relative">
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Busca por título, autor o descripción..."
                                    value="{{ request('search') }}"
                                    class="w-full px-4 py-3 pl-12 rounded-lg border-0 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-gray-800"
                                />
                                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400 text-lg"></i>
                            </div>
                            <button type="submit" class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </form>

                    <!-- Filtros -->
                    <div class="flex gap-4 flex-wrap">
                        <form action="{{ route('user.books.search') }}" method="GET" class="flex gap-2 w-full">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            
                            <div class="flex-1">
                                <select
                                    name="category_id"
                                    onchange="this.form.submit()"
                                    class="w-full px-4 py-2 rounded-lg border-0 text-gray-700"
                                >
                                    <option value="">-- Todas las categorías --</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ request('category_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if(request('search') || request('category_id'))
                                <a href="{{ route('user.books.search') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-semibold">
                                    <i class="bi bi-x"></i> Limpiar
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Grid de libros -->
            @if($books->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach($books as $book)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition transform hover:scale-105 overflow-hidden">
                            <!-- Imagen de preview -->
                            <div class="bg-gradient-to-br from-indigo-400 to-purple-500 h-48 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="bi bi-book text-6xl text-white opacity-30"></i>
                                </div>
                                <div class="relative z-10 text-center text-white p-4">
                                    <p class="text-xs font-semibold opacity-75">{{ $book->category->nombre ?? 'Sin categoría' }}</p>
                                </div>
                            </div>

                            <!-- Contenido de la tarjeta -->
                            <div class="p-4">
                                <!-- Título -->
                                <h3 class="text-lg font-bold text-gray-800 line-clamp-2 mb-1">
                                    {{ $book->title }}
                                </h3>

                                <!-- Autor -->
                                <p class="text-sm text-gray-600 mb-2">
                                    <i class="bi bi-person"></i> {{ $book->author }}
                                </p>

                                <!-- Descripción -->
                                <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                                    {{ $book->description ?? 'Sin descripción' }}
                                </p>

                                <!-- Vistas -->
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                    <span><i class="bi bi-eye"></i> {{ $book->views }} vistas</span>
                                    <span class="text-indigo-600 font-semibold">PDF</span>
                                </div>

                                <!-- Botones -->
                                <div class="flex gap-2">
                                    <a href="{{ route('user.books.show', $book) }}" class="flex-1 px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-center font-semibold text-sm">
                                        <i class="bi bi-eye"></i> Ver Detalles
                                    </a>
                                    <a href="{{ route('admin.books.download', $book) }}" class="flex-1 px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-center font-semibold text-sm">
                                        <i class="bi bi-download"></i> Descargar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="flex justify-center">
                    {{ $books->links() }}
                </div>
            @else
                <!-- Mensaje sin resultados -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <i class="bi bi-inbox text-6xl text-gray-300 mb-4 block"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No se encontraron libros</h3>
                    <p class="text-gray-600 mb-4">
                        @if(request('search'))
                            No hay libros que coincidan con tu búsqueda "<strong>{{ request('search') }}</strong>"
                        @else
                            No hay libros disponibles en esta categoría
                        @endif
                    </p>
                    <a href="{{ route('user.books.search') }}" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                        <i class="bi bi-arrow-left"></i> Ver todos los libros
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
