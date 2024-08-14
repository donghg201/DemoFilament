<?php

namespace Database\Seeders;

use App\Models\AccTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccTransaction::factory()->count(10)->create();
    }
}
