<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Book $book)
    {
        $user = auth()->user();
        
        if ($user->favoriteBooks()->where('book_id', $book->id)->exists()) {
            $user->favoriteBooks()->detach($book->id);
            $favorite = false;
        } else {
            $user->favoriteBooks()->attach($book->id);
            $favorite = true;
        }
        
        return response()->json(['favorite' => $favorite]);
    }
}
