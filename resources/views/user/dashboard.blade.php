@extends('layouts.app')

@section('content')
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
