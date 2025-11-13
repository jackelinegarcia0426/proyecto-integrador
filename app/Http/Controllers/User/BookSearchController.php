<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Categoria;
use Illuminate\Http\Request;

class BookSearchController extends Controller
{
    /**
     * Mostrar página de búsqueda de libros para usuarios
     */
    public function index(Request $request)
    {
        $query = Book::query()->where('status', 'activo');
        $categorias = Categoria::all();
        
        // Búsqueda por título o autor
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtrar por categoría
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $books = $query->paginate(12);

        return view('user.books.search', compact('books', 'categorias'));
    }

    /**
     * Ver detalles de un libro
     */
    public function show(Book $book)
    {
        // Incrementar vistas
        $book->increment('views');
        
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->where('status', 'activo')
            ->limit(4)
            ->get();

        return view('user.books.show', compact('book', 'relatedBooks'));
    }

    /**
     * Búsqueda AJAX
     */
    public function search(Request $request)
    {
        $query = Book::query()->where('status', 'activo');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $books = $query->limit(10)->get();

        return response()->json($books);
    }
}
