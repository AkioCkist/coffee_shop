<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing categories
        \App\Models\Category::truncate();
        
        // Create specific coffee shop categories
        $categories = [
            [
                'name' => 'Coffee',
                'description' => 'Hot and cold coffee beverages'
            ],
            [
                'name' => 'Pastries',
                'description' => 'Freshly baked goods'
            ],
            [
                'name' => 'Breakfast',
                'description' => 'Morning meals and specials'
            ],
            [
                'name' => 'Lunch',
                'description' => 'Sandwiches, salads, and more'
            ],
            [
                'name' => 'Desserts',
                'description' => 'Sweet treats and confections'
            ]
        ];
        
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
