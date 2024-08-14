<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(AccountTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(BusinessTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(IndividualTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(AccTransactionTableSeeder::class);
    }
}
