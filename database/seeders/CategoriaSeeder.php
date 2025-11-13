<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Ficción', 'descripcion' => 'Novelas y historias ficticiass'],
            ['nombre' => 'No Ficción', 'descripcion' => 'Libros basados en hechos reales'],
            ['nombre' => 'Ciencia Ficción', 'descripcion' => 'Historias futuristas y de ciencia ficción'],
            ['nombre' => 'Misterio', 'descripcion' => 'Novelas de misterio y suspenso'],
            ['nombre' => 'Romance', 'descripcion' => 'Libros de romance e historias de amor'],
            ['nombre' => 'Autoayuda', 'descripcion' => 'Libros de desarrollo personal y autoayuda'],
            ['nombre' => 'Historia', 'descripcion' => 'Libros sobre historia y eventos históricos'],
            ['nombre' => 'Tecnología', 'descripcion' => 'Libros sobre tecnología e informática'],
            ['nombre' => 'Educación', 'descripcion' => 'Libros educativos y académicos'],
            ['nombre' => 'Infantil', 'descripcion' => 'Libros para niños y jóvenes'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nombre' => $categoria['nombre']],
                ['descripcion' => $categoria['descripcion']]
            );
        }
    }
}
