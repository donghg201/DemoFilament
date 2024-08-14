<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Product_Id' => fake()->unique()->numerify($string = '#'),
            'Date_Offered' => fake()->date(),
            'Date_Retired' => fake()->date(),
            'Name' => fake()->name(),
            'Product_Type_Id' => fake()->numerify($string = '#'),
        ];
    }
}
