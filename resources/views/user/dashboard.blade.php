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

<div class="user-dashboard">
    <!-- Header con búsqueda -->
    <div class="search-header">
        <h1>📚 Biblioteca Virtual</h1>
        <form action="{{ route('user.dashboard') }}" method="GET" class="search-form">
            <div class="search-container">
                <input type="text" name="search" placeholder="Buscar por título o autor..." 
                       value="{{ request('search') }}" class="search-input">
                <select name="category" class="filter-select">
                    <option value="">Todas las categorías</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @if(request('category') == $cat->id) selected @endif>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="search-btn">🔍 Buscar</button>
            </div>
        </form>
    </div>

    <!-- Grid de libros -->
    <div class="books-grid">
        @forelse($books as $book)
            <div class="book-card">
                <div class="book-image">
                    <img src="{{ $book->image_url ?? 'https://via.placeholder.com/200x300?text=Sin+Portada' }}" 
                         alt="{{ $book->title }}">
                    <div class="book-overlay">
                        <a href="{{ route('admin.books.download', $book->id) }}" class="btn-leer">📖 Leer</a>
                        <button class="btn-favorito" onclick="toggleFavorite(event, {{ $book->id }})">
                            <span id="favorite-{{ $book->id }}">❤️</span> Favorito
                        </button>
                    </div>
                </div>
                <div class="book-info">
                    <h3>{{ $book->title }}</h3>
                    <p class="author">{{ $book->author }}</p>
                    <p class="category">{{ $book->category->nombre ?? 'Sin categoría' }}</p>
                    <div class="book-rating">
                        <span class="views">👁️ {{ $book->views ?? 0 }} vistas</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>📚 No se encontraron libros</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="pagination-container">
        {{ $books->links() }}
    </div>
</div>

<style>
    .user-dashboard {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 20px;
    }

    .search-header {
        max-width: 1200px;
        margin: 0 auto 50px;
        text-align: center;
        color: white;
    }

    .search-header h1 {
        font-size: 3em;
        margin-bottom: 30px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .search-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .search-container {
        display: flex;
        gap: 10px;
        background: white;
        padding: 10px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .search-input,
    .filter-select {
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 1em;
    }

    .search-input {
        min-width: 300px;
    }

    .filter-select {
        min-width: 150px;
    }

    .search-btn {
        background: #667eea;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s;
    }

    .search-btn:hover {
        background: #764ba2;
    }

    .books-grid {
        max-width: 1200px;
        margin: 0 auto 50px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 30px;
    }

    .book-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .book-image {
        position: relative;
        overflow: hidden;
        height: 300px;
    }

    .book-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .book-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .book-card:hover .book-overlay {
        opacity: 1;
    }

    .btn-leer,
    .btn-favorito {
        background: #667eea;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-leer:hover,
    .btn-favorito:hover {
        background: #764ba2;
    }

    .book-info {
        padding: 20px;
    }

    .book-info h3 {
        margin: 0 0 10px 0;
        font-size: 1.2em;
        color: #333;
    }

    .author {
        color: #667eea;
        font-style: italic;
        margin: 5px 0;
    }

    .category {
        color: #999;
        font-size: 0.9em;
        margin: 5px 0;
    }

    .book-rating {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        font-size: 0.9em;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        color: white;
        padding: 60px 20px;
        font-size: 1.5em;
    }

    .pagination-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .search-container {
            flex-direction: column;
        }

        .search-input {
            min-width: 100%;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }

        .search-header h1 {
            font-size: 2em;
        }
    }
</style>

<script>
function toggleFavorite(event, bookId) {
    event.preventDefault();
    
    fetch(`/api/book/${bookId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const icon = document.getElementById(`favorite-${bookId}`);
        if (data.favorite) {
            icon.textContent = '❤️';
            icon.style.color = '#ff0000';
        } else {
            icon.textContent = '🤍';
            icon.style.color = '#ffffff';
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection
