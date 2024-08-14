<?php

namespace Database\Factories;

use App\Models\AccTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccTransactionFactory extends Factory
{
    protected $model = AccTransaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Txn_Id' => fake()->unique()->numerify($string = '#'),
            'Amount' => fake()->randomFloat(),
            'Funds_Avail_Date' => fake()->date(),
            'Txn_Date' => fake()->date(),
            'Txn_Type_Id' => fake()->word(),
            'Account_Id' => fake()->numerify($string = '#'),
            'Execution_Branch_Id' => fake()->numerify($string = '#'),
            'Teller_Emp_Id' => fake()->numerify($string = '#'),
        ];
    }
}
