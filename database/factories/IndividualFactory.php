<?php

namespace Database\Factories;

use App\Models\Individual;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Individual>
 */
class IndividualFactory extends Factory
{
    protected $model = Individual::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Birthday' => fake()->date(),
            'First_Name' => fake()->firstName(),
            'Last_Name' => fake()->lastName(),
            'Cust_Id' => fake()->numerify($string = '#'),
        ];
    }
}
