<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('categoria')->paginate(20);
        $booksCount = Book::count();
        $categoriesCount = Categoria::count();

        return view('admin.books.index', compact('books', 'booksCount', 'categoriesCount'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.books.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'file' => 'required|file|mimes:pdf|max:20480', // max 20MB
        ]);

        $path = $request->file('file')->store('books', 'public');

        $book = Book::create([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'] ?? null,
            'categoria_id' => $data['categoria_id'] ?? null,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Libro subido correctamente');
    }

    public function edit(Book $book)
    {
        $categorias = Categoria::all();
        return view('admin.books.edit', compact('book', 'categorias'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        if ($request->hasFile('file')) {
            // delete previous
            if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
                Storage::disk('public')->delete($book->file_path);
            }
            $path = $request->file('file')->store('books', 'public');
            $book->file_path = $path;
        }

        $book->titulo = $data['titulo'];
        $book->descripcion = $data['descripcion'] ?? null;
        $book->categoria_id = $data['categoria_id'] ?? null;
        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Libro actualizado correctamente');
    }

    public function destroy(Book $book)
    {
        if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
            Storage::disk('public')->delete($book->file_path);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Libro eliminado');
    }

    public function download(Book $book)
    {
        if (!$book->file_path || !Storage::disk('public')->exists($book->file_path)) {
            abort(404);
        }

        return response()->download(
            Storage::disk('public')->path($book->file_path),
            $book->titulo . '.pdf'
        );
    }
}
