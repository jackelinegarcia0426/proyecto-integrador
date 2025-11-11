<x-app-layout>
    <x-slot name="header">
        <div class="text-center text-white bg-gradient-to-r from-indigo-500 to-purple-600 py-10 rounded-lg shadow-md">
            <h2 class="font-semibold text-3xl leading-tight mb-2 flex justify-center items-center gap-2">
                <i class="bi bi-book-half"></i> Administración de Libros
            </h2>
            <p class="opacity-90 text-lg">Gestiona tu biblioteca digital</p>
        </div>
    </x-slot>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    :root { --form-element-invalid-border-color: #d32f2f; --muted-color: #6c757d; }
    main { background: #f8f9fa; }
    .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem 0; margin-bottom: 2rem; border-radius: 0; }
    .hero h1 { margin-bottom: 0.5rem; font-size: 2rem; }
    .hero p { margin: 0; opacity: 0.95; }
    .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .stat-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
    .stat-card strong { display: block; font-size: 2rem; color: #667eea; margin-bottom: 0.5rem; }
    .stat-card small { color: #999; }
    table { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    table thead { background: #f8f9fa; border-bottom: 2px solid #e0e0e0; }
    table tbody tr { border-bottom: 1px solid #f0f0f0; transition: background 0.2s; }
    table tbody tr:hover { background: #f9f9f9; }
    .btn-group { display: flex; gap: 0.5rem; justify-content: center; align-items: center; }
    .btn { border-radius: 4px; transition: all 0.3s; padding: 0.5rem 1rem; border: none; cursor: pointer; font-size: 0.9rem; }
    .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.85rem; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
    .btn-primary { background: #667eea; color: white; }
    .btn-primary:hover { background: #5568d3; }
    .btn-success { background: #28a745; color: white; }
    .btn-warning { background: #ffc107; color: white; }
    .btn-info { background: #17a2b8; color: white; }
    .btn-danger { background: #dc3545; color: white; }
    .badge { padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.85rem; display: inline-block; }
    .empty-state { text-align: center; padding: 3rem; color: #999; }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }
    .actions-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; gap: 1rem; flex-wrap: wrap; }
    .actions-section > div { display: flex; gap: 1rem; flex-wrap: wrap; }
    .success-message { background: #d4edda; border-left: 4px solid #28a745; padding: 1rem; margin-bottom: 1rem; border-radius: 4px; }
    .success-message strong { color: #155724; }
</style>

    <main>
        <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
            
            <!-- Stats -->
            <div class="card-grid">
                <div class="stat-card">
                    <strong>{{ $booksCount }}</strong>
                    <small>Total de Libros</small>
            </div>
            <div class="stat-card">
                <strong>{{ $categoriesCount }}</strong>
                <small>Categorías</small>
            </div>
            <div class="stat-card">
                <strong>{{ $booksCount > 0 ? 'Activo' : 'Vacío' }}</strong>
                <small>Estado de Almacén</small>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions-section">
            <div>
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Subir Nuevo Libro
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if ($message = Session::get('success'))
            <div class="success-message">
                <strong>✓ Éxito:</strong> {{ $message }}
            </div>
        @endif

        <!-- Books Table -->
        @if($books->count() > 0)
            <div style="overflow-x: auto; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <table>
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> ID</th>
                            <th><i class="bi bi-book"></i> Título</th>
                            <th><i class="bi bi-tag"></i> Categoría</th>
                            <th><i class="bi bi-calendar-event"></i> Creado</th>
                            <th style="text-align: center;"><i class="bi bi-tools"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td><span class="badge" style="background: #667eea; color: white;">{{ $book->id }}</span></td>
                                <td><strong>{{ $book->titulo }}</strong></td>
                                <td>
                                    @if($book->categoria)
                                        <span class="badge" style="background: #e3f2fd; color: #1976d2;">{{ $book->categoria->nombre }}</span>
                                    @else
                                        <span class="badge" style="background: #f5f5f5; color: #999;">Sin categoría</span>
                                    @endif
                                </td>
                                <td><small>{{ $book->created_at->format('d/m/Y H:i') }}</small></td>
                                <td style="text-align: center;">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.books.download', $book) }}" class="btn btn-sm btn-info" title="Descargar">
                                            <i class="bi bi-download"></i>
                                        </a>
                                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro?')">
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

            <!-- Pagination -->
            @if($books->hasPages())
                <div style="margin-top: 2rem; text-align: center;">
                    {{ $books->links('pagination::simple-bootstrap-5') }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p><strong>No hay libros registrados</strong></p>
                <p><a href="{{ route('admin.books.create') }}">Sube tu primer libro</a></p>
            </div>
        @endif

        </div>
    </main>
</x-app-layout>
