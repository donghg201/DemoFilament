<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    protected $model = Business::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Incorp_Date' => fake()->date(),
            'Name' => fake()->name(),
            'State_Id' => fake()->word(),
            'Cust_Id' => fake()->numerify($string = '#'),
        ];
    }
}
