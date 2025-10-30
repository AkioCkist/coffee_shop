<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Cappuccino',
                'description' => 'A coffee drink with espresso, hot milk, and steamed milk foam',
                'price' => 35000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
            ],
            [
                'category_id' => 1,
                'name' => 'Espresso',
                'description' => 'Strong black coffee made by forcing steam through ground coffee beans',
                'price' => 30000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1510707577719-ae7ece3a8b01',
            ],
            [
                'category_id' => 1,
                'name' => 'Latte',
                'description' => 'Coffee with steamed milk and a small amount of milk foam',
                'price' => 38000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f',
            ],
            [
                'category_id' => 2,
                'name' => 'Blueberry Muffin',
                'description' => 'Freshly baked muffin filled with juicy blueberries',
                'price' => 25000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1576618148400-f54bed99fcfd',
            ],
            [
                'category_id' => 2,
                'name' => 'Croissant',
                'description' => 'Buttery and flaky French pastry',
                'price' => 28000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a',
            ],
            [
                'category_id' => 3,
                'name' => 'Breakfast Sandwich',
                'description' => 'Egg, cheese, and bacon on a toasted English muffin',
                'price' => 45000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8',
            ],
            [
                'category_id' => 4,
                'name' => 'Chicken Salad',
                'description' => 'Fresh greens with grilled chicken and house dressing',
                'price' => 58000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd',
            ],
            [
                'category_id' => 5,
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate cake with ganache frosting',
                'price' => 42000,
                'currency' => 'VNĐ',
                'display_image_url' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587',
            ]
        ];
        
        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
