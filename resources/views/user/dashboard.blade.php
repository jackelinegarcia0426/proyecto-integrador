<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-center gap-3">
                <i class="bi bi-book-half text-2xl text-indigo-600"></i>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800">Mi Biblioteca</h2>
                    <p class="text-sm opacity-75 mt-1">Bienvenido a tu biblioteca virtual</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-lg p-8 mb-12 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">¡Bienvenido a la Biblioteca Virtual!</h1>
                        <p class="text-indigo-100">Explora miles de libros, busca tus favoritos y descárgalos en un instante</p>
                    </div>
                    <div class="hidden md:block text-6xl opacity-30">
                        <i class="bi bi-book"></i>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total de Libros</p>
                            <p class="text-3xl font-bold text-indigo-600">{{ \App\Models\Book::where('status', 'activo')->count() }}</p>
                        </div>
                        <i class="bi bi-book-half text-4xl text-indigo-200"></i>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Categorías</p>
                            <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Categoria::count() }}</p>
                        </div>
                        <i class="bi bi-collection text-4xl text-purple-200"></i>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Libros Más Vistos</p>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Book::where('status', 'activo')->max('views') ?? 0 }}</p>
                        </div>
                        <i class="bi bi-graph-up text-4xl text-green-200"></i>
                    </div>
                </div>
            </div>

            <!-- Quick Access Button -->
            <div class="text-center mb-12">
                <a href="{{ route('user.books.search') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold text-lg shadow-lg hover:shadow-xl">
                    <i class="bi bi-search text-2xl"></i>
                    <span>Ir a Buscar y Descargar Libros</span>
                </a>
            </div>

            <!-- Featured Books -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                    <i class="bi bi-star text-yellow-500"></i>
                    Libros Destacados
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach(\App\Models\Book::where('status', 'activo')->orderByDesc('views')->limit(4)->get() as $book)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition transform hover:scale-105 overflow-hidden group">
                            <!-- Preview -->
                            <div class="bg-gradient-to-br from-indigo-400 to-purple-500 h-48 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-4 text-center">
                                    <i class="bi bi-book text-6xl opacity-30 mb-2"></i>
                                    <p class="text-xs font-semibold opacity-75 uppercase">{{ $book->category->nombre ?? 'Sin categoría' }}</p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 line-clamp-2 mb-1">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    <i class="bi bi-person"></i> {{ $book->author }}
                                </p>
                                <p class="text-xs text-gray-500 mb-4">
                                    <i class="bi bi-eye"></i> {{ $book->views }} vistas
                                </p>
                                
                                <div class="flex gap-2">
                                    <a href="{{ route('user.books.show', $book) }}" class="flex-1 px-3 py-2 bg-indigo-600 text-white rounded text-center text-xs font-semibold hover:bg-indigo-700 transition">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('user.books.download', $book) }}" class="flex-1 px-3 py-2 bg-green-600 text-white rounded text-center text-xs font-semibold hover:bg-green-700 transition">
                                        <i class="bi bi-download"></i> Descargar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Categories Section -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                    <i class="bi bi-collection text-purple-600"></i>
                    Categorías Disponibles
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    @foreach(\App\Models\Categoria::all() as $categoria)
                        <a href="{{ route('user.books.search', ['category_id' => $categoria->id]) }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg hover:bg-indigo-50 transition text-center group">
                            <div class="text-4xl mb-3 group-hover:scale-125 transition">
                                <i class="bi bi-collection text-indigo-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-1">{{ $categoria->nombre }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ $categoria->descripcion }}</p>
                            <p class="text-xs font-semibold text-indigo-600">
                                {{ \App\Models\Book::where('category_id', $categoria->id)->where('status', 'activo')->count() }} libros
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
