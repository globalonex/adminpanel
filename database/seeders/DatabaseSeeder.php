<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        // \App\Models\User::factory(10)->create();
//        Category::factory()->count(5)->create();
//        Product::factory()->count(20)->create();


        $categories = [
            'Закуски',
            'Супы',
            'Основные блюда из мяса',
            'Основные блюда из рыбы',
            'Гарниры',
            'Салаты',
            'Закуски к пиву',
            'Десерты',
            'Напитки',
        ];
        // Create the categories in the database
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        // Генерируем продукты для каждой категории
        foreach ($categories as $category) {
            $products = $this->getProductsForCategory($category);
            foreach ($products as $product) {
                $product = new Product([
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'categories_id' => Category::where('name', $category)->first()->id,
                ]);
                $product->save();
            }

        }
    }

    /**
     * Возвращает массив продуктов для указанной категории
     *
     * @param string $category Название категории
     * @return array Массив продуктов
     */
    private function getProductsForCategory($category)
    {
        switch ($category) {
            case 'Закуски':
                return [
                    [
                        'name' => 'Селедка под шубой',
                        'quantity' => 86,
                        'price' => 150,
                    ],
                    [
                        'name' => 'Оливье',
                        'quantity' => 32,
                        'price' => 120,
                    ],
                    [
                        'name' => 'Холодец',
                        'quantity' => 18,
                        'price' => 200,
                    ],
                ];
                break;
            case 'Супы':
                return [
                    [
                        'name' => 'Борщ',
                        'quantity' => 75,
                        'price' => 150,
                    ],
                    [
                        'name' => 'Солянка',
                        'quantity' => 24,
                        'price' => 170,
                    ],
                    [
                        'name' => 'Уха',
                        'quantity' => 33,
                        'price' => 200,
                    ],
                ];
                break;
            case 'Основные блюда из мяса':
                return [
                    [
                        'name' => 'Шашлык из свинины',
                        'quantity' => 64,
                        'price' => 300,
                    ],
                    [
                        'name' => 'Говядина стейк',
                        'quantity' => 1,
                        'price' => 450,
                    ],
                    [
                        'name' => 'Котлеты по-киевски',
                        'quantity' => 5,
                        'price' => 250,
                    ],
                ];
                break;
            case 'Основные блюда из рыбы':
                return [
                    [
                        'name' => 'Жареная форель',
                        'quantity' => 9,
                        'price' => 350,
                    ],
                    [
                        'name' => 'Семга на гриле',
                        'quantity' => 2,
                        'price' => 400,
                    ],
                    [
                        'name' => 'Рыбные котлеты',
                        'quantity' => 8,
                        'price' => 200,
                    ],
                ];
                break;
            case 'Гарниры':
                return [
                    [
                        'name' => 'Картофельное пюре',
                        'quantity' => 1,
                        'price' => 80,
                    ],
                    [
                        'name' => 'Овощной салат',
                        'quantity' => 5,
                        'price' => 100,
                    ],
                    [
                        'name' => 'Рис с овощами',
                        'quantity' => 4,
                        'price' => 120,
                    ],
                ];
                break;
            default:
                return [];
        }
    }

}
