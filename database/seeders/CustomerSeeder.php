<?php

namespace Database\Seeders;

use App\Models\Customer;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Customer::factory()
        ->count(25)
        ->hasInovices(10)
        ->create();
    }
}
