<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'El Quijote de la Mancha',
                'author' => 'Miguel de Cervantes',
                'description' => 'Una novela clásica española sobre las aventuras de Don Quijote de la Mancha y su escudero Sancho Panza. Una de las obras maestras de la literatura universal.',
                'isbn' => '978-84-376-0494-9',
                'category_id' => 1,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'Cien años de soledad',
                'author' => 'Gabriel García Márquez',
                'description' => 'Una novela de realismo mágico que narra la historia de la familia Buendía a lo largo de cien años en el pueblo de Macondo.',
                'isbn' => '978-84-322-0070-0',
                'category_id' => 1,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'La Casa de Espíritus',
                'author' => 'Isabel Allende',
                'description' => 'Una saga familiar que abarca cuatro generaciones, mezclando lo real con lo místico en un contexto histórico latinoamericano.',
                'isbn' => '978-84-204-5237-3',
                'category_id' => 1,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'Una novela distópica que presenta un futuro totalitario donde la vigilancia y el control son absolutos.',
                'isbn' => '978-84-339-5194-7',
                'category_id' => 3,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'Fundación',
                'author' => 'Isaac Asimov',
                'description' => 'Una novela de ciencia ficción que narra el colapso del imperio galáctico y los intentos de preservar el conocimiento.',
                'isbn' => '978-84-450-7370-1',
                'category_id' => 3,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'El Crimen del Conde Nevsky',
                'author' => 'Boris Akunin',
                'description' => 'Una novela de misterio y suspense con el detective Erast Fandorin investigando crímenes en la Rusia Imperial.',
                'isbn' => '978-84-344-6799-9',
                'category_id' => 4,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'Orgullo y Prejuicio',
                'author' => 'Jane Austen',
                'description' => 'Una novela romántica clásica que explora los sentimientos, el amor y el matrimonio en la Inglaterra del siglo XIX.',
                'isbn' => '978-84-7509-987-1',
                'category_id' => 5,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'El Camino',
                'author' => 'Miguel Delibes',
                'description' => 'Una novela sobre la infancia en la España rural, narrando el desarrollo de un niño entre amigos y aventuras.',
                'isbn' => '978-84-234-1234-0',
                'category_id' => 1,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'Hábitos Atómicos',
                'author' => 'James Clear',
                'description' => 'Un libro sobre cómo los pequeños cambios pueden llevar a resultados extraordinarios. Una guía práctica para mejorar tus hábitos.',
                'isbn' => '978-84-414-3966-9',
                'category_id' => 6,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'Breve Historia del Tiempo',
                'author' => 'Stephen Hawking',
                'description' => 'Una exploración de los misterios del universo, desde el Big Bang hasta los agujeros negros, explicado en términos accesibles.',
                'isbn' => '978-84-204-3932-9',
                'category_id' => 8,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
            [
                'title' => 'El Principito',
                'author' => 'Antoine de Saint-Exupéry',
                'description' => 'Un cuento poético sobre un príncipe que viaja por el universo descubriendo verdades sobre la vida y el amor.',
                'isbn' => '978-84-204-9965-8',
                'category_id' => 10,
                'status' => 'activo',
                'views' => rand(100, 500),
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['title' => $book['title']],
                $book
            );
        }
    }
}
