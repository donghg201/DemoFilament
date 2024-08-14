<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    protected $model = Branch::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Branch_Id' => fake()->unique()->numerify($string = '#'),
            'Address' => fake()->address(),
            'City' => fake()->city(),
            'Name' => fake()->name(),
            'State' => fake()->state(),
            'Zip_Code' => fake()->postcode(),
        ];
    }
}
