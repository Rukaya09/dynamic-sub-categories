<?php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'icon' => null,
            'icon_storage_type' => 'public',
            'parent_id' => 0,
            'position' => $this->faker->numberBetween(1, 10),
            'home_status' => $this->faker->boolean,
            'priority' => $this->faker->optional()->numberBetween(1, 10),
        ];
    }
}