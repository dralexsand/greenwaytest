<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 1117;
        $i = 1;
        while ($i <= $count) {
            OrderItem::create([
                'user_id' => random_int(1, count(User::get())),
                'order_id' => random_int(1, count(Order::get())),
            ]);
            $i++;
        }
    }
}
