<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Account_Id' => fake()->unique()->numerify($string = '#'),
            'Avail_Balance' => fake()->randomFloat(),
            'Close_Date' => fake()->date(),
            'Last_Activity_Date' => fake()->date(),
            'Open_Date' => fake()->date(),
            'Pending_Balance' => fake()->randomFloat(),
            'Status' => 'On',
            'Cust_Id' => fake()->numerify($string = '#'),
            'Open_Branch_Id' => fake()->numerify($string = '#'),
            'Open_Emp_Id' => fake()->numerify($string = '#'),
            'Product_Id' => fake()->numerify($string = '#'),
            'User_Id' => fake()->numerify($string = '#'),
        ];
    }
}
