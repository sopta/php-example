<?php

declare(strict_types=1);

namespace Example;

use Illuminate\Database\Capsule\Manager as Capsule;
use stdClass;

final class OrderService implements OrderServiceInterface
{
    public function GetOrderDetail(string $id): stdClass
    {
        $order = Capsule::table('order')
            ->where('order.id', '=', $id)
            ->first();

        $items = Capsule::table('order_item')
            ->where('order_id', '=', $id)
            ->get();

        $order->items = $items->toArray();

        return $order;
    }

    public function GetAllOrders(): array
    {
        return Capsule::table('order')->get()->all();
    }
}
