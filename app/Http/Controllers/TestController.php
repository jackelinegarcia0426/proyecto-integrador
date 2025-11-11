<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function test()
    {
        return response()->json([
            'status' => 'OK',
            'books' => \App\Models\Book::count(),
            'roles' => \App\Models\Role::count(),
            'users' => \App\Models\User::count(),
        ]);
    }
}
