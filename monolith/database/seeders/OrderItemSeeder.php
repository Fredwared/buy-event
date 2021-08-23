<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
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
        $ordersCount = Order::query()->count();

        OrderItem::factory()
            ->count(($ordersCount * rand(3,6)))
            ->create();
    }
}
