<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookSearchController extends Controller
{
    /**
     * Búsqueda de libros para usuarios
     */
    public function searchUser(Request $request)
    {
        $query = Book::query();
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }
        
        $books = $query->paginate(12);
        $categories = \App\Models\Categoria::all();
        
        return view('user.dashboard', compact('books', 'categories'));
    }
    
    /**
     * Búsqueda de libros para administrador
     */
    public function searchAdmin(Request $request)
    {
        $query = Book::query();
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        $books = $query->paginate(10);
        
        return view('admin.dashboard', compact('books'));
    }
}
