<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Cust_Id' => fake()->unique()->numerify($string = '#'),
            'Address' => fake()->address(),
            'City' => fake()->city(),
            'Cust_Type_Id' => fake()->word(),
            'Fed_Id' => fake()->word(),
            'Postal_Code' => fake()->postcode(),
            'State' => fake()->state(),
        ];
    }
}
