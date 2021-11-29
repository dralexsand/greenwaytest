<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(13)->create();
        \App\Models\Order::factory(111)->create();
        $this->call(UserCartSeeder::class);
        $this->call(OrderItemSeeder::class);
    }
}
