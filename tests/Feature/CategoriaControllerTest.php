<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_categoria()
    {
        Categoria::create(['nombre' => 'Ficción']);
        $this->assertDatabaseHas('categorias', ['nombre' => 'Ficción']);
    }

    public function test_can_read_categoria()
    {
        $cat = Categoria::create(['nombre' => 'Ficción']);
        $found = Categoria::find($cat->id);
        $this->assertEquals($cat->nombre, $found->nombre);
    }

    public function test_can_update_categoria()
    {
        $cat = Categoria::create(['nombre' => 'Ficción']);
        $cat->update(['nombre' => 'Fantasía']);
        $this->assertDatabaseHas('categorias', ['id' => $cat->id, 'nombre' => 'Fantasía']);
    }

    public function test_can_delete_categoria()
    {
        $cat = Categoria::create(['nombre' => 'Ficción']);
        $cat->delete();
        $this->assertDatabaseMissing('categorias', ['id' => $cat->id]);
    }
}
