<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this -> faker -> name(),
            "image" => "avatar-2.jpg",
            "description"  => $this->faker -> paragraph(5),
            "price" => $this -> faker -> randomFloat(2,9,9999999),
            "quantity" => $this -> faker -> randomNumber(4),
            "category_id" => Category::all()->random()->id
        ];
    }
}
