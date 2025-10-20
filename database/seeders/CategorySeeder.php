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
        $ingredients = [
            'Beef','Chicken','Pork','Lamb','Turkey','Duck','Salmon','Tuna','Cod','Trout','Shrimp','Prawn',
            'Crab','Lobster','Scallop','Oyster','Mussels','Sausage','Bacon','Ham','Ground Beef','Meatball',
            'Tofu','Tempeh','Egg','Cheese','Mozzarella','Parmesan','Cheddar','Yogurt','Milk','Butter',
            'Rice','Brown Rice','Basmati Rice','Sushi Rice','Noodles','Pasta','Spaghetti','Ravioli',
            'Bread','Baguette','Burger','Hot Dog','Pizza','Taco','Burrito','Quesadilla','Salad','Caesar Salad',
            'Coleslaw','Soup','Stew','Chili','Curry','Kebab','Falafel','Hummus','Pancake','Waffle','Crepe',
            'Cake','Brownie','Cookie','Pastry','Croissant','Doughnut','Ice Cream','Sorbet','Gelato',
            'Fruit','Apple','Banana','Orange','Mango','Pineapple','Strawberry','Blueberry','Raspberry',
            'Avocado','Tomato','Potato','Sweet Potato','Mushroom','Onion','Garlic','Spinach','Kale','Lettuce',
            'Broccoli','Cauliflower','Carrot','Peas','Corn','Beans','Lentils','Chickpeas','Quinoa','Oats',
            'Cereal','Granola','Chocolate','Coffee','Tea','Espresso','Latte','Cappuccino','Mocha','Cold Brew',
            'Juice','Smoothie','Milkshake','Soda','Water','Sparkling Water','Cocktail','Beer','Wine','Champagne',
            'Whiskey','Vodka','Rum','Gin','Tequila','Sake','Herbal Tea','Iced Tea','Lemonade'
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
