<?php

namespace Database\Seeders;

use App\Data\Models\Cart;
use App\Data\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()
            ->count(10)
            ->has(Cart::factory()->count(1))
            ->create();
    }
}
