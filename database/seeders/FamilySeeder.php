<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = [
            'Pastelería' => [
                'Tortas' => [
                    'Torta negra',
                    'Tres leches',
                    'Zanahoria',
                    'Chocolate',
                    'Ponqué de naranja',
                ],
                'Postres fríos' => [
                    'Merengón',
                    'Cheesecake',
                    'Mousse de maracuyá',
                    'Postre de natas',
                    'Flan de caramelo',
                ],
                'Hojaldres y galletas' => [
                    'Milhojas',
                    'Pasteles de arequipe',
                    'Galletas de mantequilla',
                    'Cucas',
                ],
            ],
            'Dulces típicos santandereanos' => [
                'Bocadillos' => [
                    'Bocadillo veleño en hoja de bijao',
                    'Bocadillo con arequipe',
                    'Bocadillo en lonja',
                    'Bocadillo con queso',
                ],
                'Obleas' => [
                    'Arequipe',
                    'Arequipe y queso',
                    'Mora',
                    'Oblea especial de Floridablanca',
                ],
                'Dulces de leche' => [
                    'Cortado de leche de cabra',
                    'Arequipe',
                    'Panelitas de leche',
                    'Manjar blanco',
                ],
                'Dulces de frutas' => [
                    'Brevas con arequipe',
                    'Papayuela',
                    'Dulce de mora',
                    'Dulce de guayaba',
                ],
                'Panela y melcochas' => [
                    'Melcochas',
                    'Alfandoque',
                    'Cocadas',
                    'Panela',
                ],
            ],
            'Panadería y amasijos' => [
                'Panes' => [
                    'Pan de queso',
                    'Pan de yuca',
                    'Pan de maíz',
                    'Pan dulce',
                ],
                'Arepas' => [
                    'Arepa santandereana',
                    'Arepa de maíz pelado',
                    'Arepa de queso',
                ],
                'Bizcochería' => [
                    'Almojábanas',
                    'Roscones',
                    'Mantecadas',
                    'Bizcochos de queso',
                ],
            ],
            'Chocolatería y cacao' => [
                'Chocolates' => [
                    'Barras de cacao',
                    'Bombones',
                    'Trufas',
                    'Frutas cubiertas de chocolate',
                ],
                'Cacao de Santander' => [
                    'Cacao de San Vicente de Chucurí',
                    'Chocolate de mesa',
                    'Nibs de cacao',
                ],
            ],
            'Sabores de Santander' => [
                'Snacks típicos' => [
                    'Hormigas culonas',
                    'Hormigas culonas cubiertas de chocolate',
                ],
                'Bebidas' => [
                    'Café de Santander',
                    'Chocolate caliente',
                    'Agua de panela',
                ],
            ],
            'Regalos y eventos' => [
                'Anchetas' => [
                    'Ancheta santandereana',
                    'Ancheta de dulces',
                    'Ancheta de chocolates',
                ],
                'Cajas surtidas' => [
                    'Caja de obleas',
                    'Caja de bocadillos',
                    'Caja de dulces típicos',
                ],
                'Eventos' => [
                    'Mesa de postres',
                    'Tortas personalizadas',
                    'Recordatorios dulces',
                ],
            ],
        ];

        foreach ($families as $family => $categories) {

            $family = Family::create([
                'name' => $family,
            ]);

            foreach ($categories as $category => $subcategories) {

                $category = Category::create([
                    'name' => $category,
                    'family_id' => $family->id,
                ]);

                foreach ($subcategories as $subcategory) {
                    Subcategory::create([
                        'name' => $subcategory,
                        'category_id' => $category->id,
                    ]);
                }
            }
        }
    }
}
