<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Emp_Id' => fake()->unique()->numerify($string = '#'),
            'End_Date' => fake()->date("Y-m-d"),
            'First_Name' => fake()->firstName(),
            'Last_Name' => fake()->lastName(),
            'Start_Date' => fake()->date("Y-m-d"),
            'Title' => fake()->name(),
            'Assigned_Branch_Id' => fake()->numerify($string = '#'),
            'Dept_Id' => fake()->numerify($string = '#'),
            'Superior_Emp_Id' => fake()->numerify($string = '#'),
        ];
    }
}
