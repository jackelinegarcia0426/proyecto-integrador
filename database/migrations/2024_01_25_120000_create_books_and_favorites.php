<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Crear tabla books si no existe
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('author');
                $table->longText('description')->nullable();
                $table->string('isbn')->unique()->nullable();
                $table->unsignedBigInteger('category_id')->nullable();
                $table->string('image_url')->nullable();
                $table->string('file_path')->nullable();
                $table->enum('status', ['activo', 'inactivo'])->default('activo');
                $table->integer('views')->default(0);
                $table->timestamps();
                
                $table->foreign('category_id')->references('id')->on('categorias')->onDelete('set null');
                
                $table->index('title');
                $table->index('author');
                $table->index('status');
            });
        }
        
        // Crear tabla book_favorites si no existe
        if (!Schema::hasTable('book_favorites')) {
            Schema::create('book_favorites', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('book_id');
                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
                
                $table->unique(['user_id', 'book_id']);
                $table->index('user_id');
                $table->index('book_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('book_favorites');
        Schema::dropIfExists('books');
    }
};
