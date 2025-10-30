<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    public const DEFAULT_CURRENCY = 'VNĐ';
    
    public $products = [
        [
            'category_id' => 1,
            'name' => 'Cappuccino',
            'description' => 'A coffee drink with espresso, hot milk, and steamed milk foam',
            'price' => 35000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'category_id' => 1,
            'name' => 'Espresso',
            'description' => 'Strong black coffee made by forcing steam through ground coffee beans',
            'price' => 30000,
            'display_image_url' => 'https://images.unsplash.com/photo-1510707577719-ae7ece3a8b01',
        ],
        [
            'category_id' => 1,
            'name' => 'Latte',
            'description' => 'Coffee with steamed milk and a small amount of milk foam',
            'price' => 38000,
            'display_image_url' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f',
        ],
        [
            'category_id' => 2,
            'name' => 'Blueberry Muffin',
            'description' => 'Freshly baked muffin filled with juicy blueberries',
            'price' => 25000,
            'display_image_url' => 'https://images.unsplash.com/photo-1576618148400-f54bed99fcfd',
        ],
        [
            'category_id' => 2,
            'name' => 'Croissant',
            'description' => 'Buttery and flaky French pastry',
            'price' => 28000,
            'display_image_url' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a',
        ],
        [
            'id' => 3,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 4,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 5,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 6,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 7,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 8,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 9,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 10,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 11,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
        [
            'id' => 12,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'display_image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93',
        ],
    ];

    private function getProducts()
    {
        return collect($this->products);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getProducts() as $product) {
            $product['currency'] = self::DEFAULT_CURRENCY;

            Product::create($product);
        }
    }
}
