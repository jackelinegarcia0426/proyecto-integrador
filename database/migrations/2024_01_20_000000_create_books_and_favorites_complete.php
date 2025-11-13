<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
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
                $table->foreignId('category_id')->nullable()->constrained('categorias')->onDelete('set null');
                $table->string('image_url')->nullable();
                $table->string('file_path')->nullable();
                $table->enum('status', ['activo', 'inactivo'])->default('activo');
                $table->integer('views')->default(0);
                $table->timestamps();
                
                $table->index('title');
                $table->index('author');
                $table->index('status');
            });
        }
        
        // Crear tabla book_favorites si no existe
        if (!Schema::hasTable('book_favorites')) {
            Schema::create('book_favorites', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
                $table->timestamps();
                
                $table->unique(['user_id', 'book_id']);
                $table->index('user_id');
                $table->index('book_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_favorites');
        Schema::dropIfExists('books');
    }
};
