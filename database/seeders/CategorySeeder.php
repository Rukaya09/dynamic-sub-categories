<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Creating 5 parent categories
        $parentCategories = [];
        for ($i = 1; $i <= 5; $i++) {
            $parentCategories[] = Category::create([
                'name' => 'Parent Category ' . $i,
                'slug' => 'parent-category-' . $i,
                'parent_id' => 0,  // No parent (root category)
                'position' => $i,
                'home_status' => 1,
                'priority' => $i,
            ]);
        }

        // Creating 5 child categories for each parent
        foreach ($parentCategories as $parent) {
            $childCategories = [];
            for ($j = 1; $j <= 5; $j++) {
                $childCategories[] = Category::create([
                    'name' => 'Child Category ' . $j . ' of ' . $parent->name,
                    'slug' => 'child-category-' . $j . '-of-' . $parent->slug,
                    'parent_id' => $parent->id,
                    'position' => $j,
                    'home_status' => 0,
                    'priority' => $j,
                ]);
            }

            // Creating 5 child-child categories for each child
            foreach ($childCategories as $child) {
                for ($k = 1; $k <= 5; $k++) {
                    Category::create([
                        'name' => 'Child-Child Category ' . $k . ' of ' . $child->name,
                        'slug' => 'child-child-category-' . $k . '-of-' . $child->slug,
                        'parent_id' => $child->id,
                        'position' => $k,
                        'home_status' => 0,
                        'priority' => $k,
                    ]);
                }
            }
        }

        // Success message for seeding
        $this->command->info('Categories seeded successfully!');
    }
}
