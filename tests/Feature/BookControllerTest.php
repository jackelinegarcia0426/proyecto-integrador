<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        
        $role = Role::firstOrCreate(['nombre' => 'admin'], ['descripcion' => 'Admin']);
        $this->user = User::factory()->create(['rol_id' => $role->id]);
    }

    public function test_index_view()
    {
        $response = $this->actingAs($this->user)->get('/admin/books');
        $response->assertStatus(200);
    }

    public function test_create_view()
    {
        $response = $this->actingAs($this->user)->get('/admin/books/create');
        $response->assertStatus(200);
    }

    public function test_store_book()
    {
        $file = UploadedFile::fake()->create('test.pdf', 100, 'application/pdf');
        $response = $this->actingAs($this->user)->post('/admin/books', [
            'titulo' => 'Prueba',
            'file' => $file,
        ]);
        $response->assertRedirect('/admin/books');
    }

    public function test_edit_view()
    {
        $book = Book::create([
            'titulo' => 'Test Book',
            'file_path' => 'test.pdf',
        ]);
        $response = $this->actingAs($this->user)->get("/admin/books/{$book->id}/edit");
        $response->assertStatus(200);
    }

    public function test_delete_book()
    {
        $book = Book::create([
            'titulo' => 'Test Book',
            'file_path' => 'test.pdf',
        ]);
        $response = $this->actingAs($this->user)->delete("/admin/books/{$book->id}");
        $response->assertRedirect('/admin/books');
    }
}

