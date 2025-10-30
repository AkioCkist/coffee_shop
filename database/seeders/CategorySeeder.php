<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            Category::create($category);
        }

        // Additional generated category logic
        $ingredients = [
            'Chicken','Beef','Pork','Fish','Tofu','Rice','Noodles','Bread','Egg','Cheese',
            'Tomato','Potato','Onion','Garlic','Mushroom','Spinach','Carrot','Cucumber','Lettuce','Corn'
        ];

        $preparations = [
            'Grilled','Fried','Baked','Roasted','Steamed','Smoked','Boiled','Braised','Pan-Seared','Sautéed',
            'Stir-Fried','Crispy','Glazed','Caramelized','Stuffed','Marinated','Pickled','Cured','Slow-Cooked',
            'Charred','Blackened','Teriyaki','BBQ','Spicy','Sweet','Sour','Creamy','Herbed','Garlic','Lemon',
            'Honey','Maple','Coconut','Thai-style','Indian-style','Mediterranean','Mexican-style'
        ];

        $cuisines = [
            'Italian','French','Chinese','Japanese','Mexican','Thai','Indian','Mediterranean','Greek','Spanish',
            'Lebanese','Turkish','Korean','Vietnamese','Caribbean','American','Brazilian','Peruvian','German','Ethiopian'
        ];

        $drinkModifiers = [
            'Hot','Iced','Sparkling','Fresh','Classic','Herbal','Alcoholic','Non-alcoholic','Frozen','Blended','Protein',
            'Smoothie','Frappé','Cold Brew','Nitro','Infused'
        ];

        $records = [];
        $namesSet = [];
        $id = 1;
        $now = now();

        // Add simple ingredient names first
        foreach ($ingredients as $ing) {
            if ($id > 1000) break;
            $name = $ing;
            if (isset($namesSet[$name])) continue;
            $namesSet[$name] = true;
            $records[] = [
                'id' => $id++,
                'name' => $name,
                'description' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Combine preparations with ingredients
        foreach ($preparations as $prep) {
            foreach ($ingredients as $ing) {
                if ($id > 1000) break 2;
                $name = "$prep $ing";
                if (isset($namesSet[$name])) continue;
                $namesSet[$name] = true;
                $records[] = [
                    'id' => $id++,
                    'name' => $name,
                    'description' => '',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Combine cuisines with ingredients
        foreach ($cuisines as $cuisine) {
            foreach ($ingredients as $ing) {
                if ($id > 1000) break 2;
                $name = "$cuisine $ing";
                if (isset($namesSet[$name])) continue;
                $namesSet[$name] = true;
                $records[] = [
                    'id' => $id++,
                    'name' => $name,
                    'description' => '',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Add drink modifiers with drink-related items
        $drinkBases = ['Coffee','Tea','Juice','Smoothie','Cocktail','Milkshake','Beer','Wine','Soda','Lemonade','Water'];
        foreach ($drinkModifiers as $mod) {
            foreach ($drinkBases as $db) {
                if ($id > 1000) break 2;
                $name = "$mod $db";
                if (isset($namesSet[$name])) continue;
                $namesSet[$name] = true;
                $records[] = [
                    'id' => $id++,
                    'name' => $name,
                    'description' => '',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Fallback: generate variations to reach 1000 if needed
        $modifiers = ['Special','Deluxe','House','Signature','Classic','Traditional','Vegetarian','Vegan','Gluten-Free','Low-Carb'];
        $allBases = array_merge($ingredients, $drinkBases);
        for ($i = 0; $id <= 1000; $i++) {
            $base = $allBases[$i % count($allBases)];
            $mod = $modifiers[$i % count($modifiers)];
            $name = "$mod $base";
            if (isset($namesSet[$name])) continue;
            $namesSet[$name] = true;
            $records[] = [
                'id' => $id++,
                'name' => $name,
                'description' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Upsert will insert new or replace existing records by id
        Category::upsert($records, ['id'], ['name', 'description', 'updated_at']);
    }
}
