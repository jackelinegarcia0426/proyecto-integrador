@extends('layouts.app')

@section('content')
<div class="admin-dashboard">
    <div class="admin-header">
        <h1>📚 Gestión de Libros</h1>
        <a href="{{ route('admin.books.create') }}" class="btn-nuevo">➕ Nuevo Libro</a>
    </div>

    <!-- Búsqueda y Filtros -->
    <div class="admin-search">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
            <input type="text" name="search" placeholder="Buscar por título, autor o ISBN..." 
                   value="{{ request('search') }}" class="search-input">
            <select name="status" class="filter-select">
                <option value="">Todos los estados</option>
                <option value="activo" @if(request('status') === 'activo') selected @endif>Activo</option>
                <option value="inactivo" @if(request('status') === 'inactivo') selected @endif>Inactivo</option>
            </select>
            <button type="submit" class="btn-filtrar">🔍 Filtrar</button>
        </form>
    </div>

    <!-- Tabla de libros -->
    <div class="table-container">
        <table class="books-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoría</th>
                    <th>ISBN</th>
                    <th>Estado</th>
                    <th>Vistas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td><strong>{{ $book->title }}</strong></td>
                        <td>{{ $book->author }}</td>
                        <td><span class="badge">{{ $book->category->nombre ?? 'Sin cat.' }}</span></td>
                        <td>{{ $book->isbn ?? 'N/A' }}</td>
                        <td>
                            <span class="status {{ $book->status }}">
                                {{ ucfirst($book->status) }}
                            </span>
                        </td>
                        <td>{{ $book->views ?? 0 }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn-edit">✏️ Editar</a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro?')">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-message">No se encontraron libros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="pagination-container">
        {{ $books->links() }}
    </div>
</div>

<style>
    .admin-dashboard {
        background: #f5f7fa;
        min-height: 100vh;
        padding: 30px 20px;
    }

    .admin-header {
        max-width: 1400px;
        margin: 0 auto 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .admin-header h1 {
        margin: 0;
        color: #333;
        font-size: 2em;
    }

    .btn-nuevo {
        background: #28a745;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s;
    }

    .btn-nuevo:hover {
        background: #218838;
    }

    .admin-search {
        max-width: 1400px;
        margin: 0 auto 30px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .filter-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-input,
    .filter-select {
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
    }

    .search-input {
        flex: 1;
        min-width: 300px;
    }

    .btn-filtrar {
        background: #667eea;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s;
    }

    .btn-filtrar:hover {
        background: #764ba2;
    }

    .table-container {
        max-width: 1400px;
        margin: 0 auto 30px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .books-table {
        width: 100%;
        border-collapse: collapse;
    }

    .books-table thead {
        background: #667eea;
        color: white;
    }

    .books-table th {
        padding: 15px;
        text-align: left;
        font-weight: bold;
    }

    .books-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .books-table tbody tr:hover {
        background: #f9f9f9;
    }

    .badge {
        background: #e7f3ff;
        color: #0066cc;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: bold;
    }

    .status {
        padding: 5px 12px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 0.9em;
    }

    .status.activo {
        background: #d4edda;
        color: #155724;
    }

    .status.inactivo {
        background: #f8d7da;
        color: #721c24;
    }

    .actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-edit,
    .btn-delete {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        text-decoration: none;
        font-size: 0.9em;
        transition: opacity 0.3s;
    }

    .btn-edit {
        background: #ffc107;
        color: #333;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-edit:hover,
    .btn-delete:hover {
        opacity: 0.8;
    }

    .empty-message {
        text-align: center;
        color: #999;
        padding: 40px 15px !important;
        font-style: italic;
    }

    .pagination-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .admin-header {
            flex-direction: column;
            gap: 15px;
        }

        .filter-form {
            flex-direction: column;
        }

        .books-table {
            font-size: 0.9em;
        }

        .books-table th,
        .books-table td {
            padding: 10px;
        }
    }
</style>
@endsection
