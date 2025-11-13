<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'category_id',
        'image_url',
        'file_path',
        'status',
        'views',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación con Categoría
     */
    public function category()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    /**
     * Relación con usuarios (favoritos)
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'book_favorites');
    }
}
