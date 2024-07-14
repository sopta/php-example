<?php

namespace Example;

use stdClass;

final class DummyOrderService implements OrderServiceInterface
{
    public function GetOrderDetail(string $id): stdClass
    {
        $order = new stdClass();
        $order->id = 1;
        $order->total = 100;
        $order->currency = 'CZK';
        $order->state = 'new';
        $order->created_at = time();
        $order->items = [];

        return $order;
    }

    public function GetAllOrders(): array
    {
        $orders = [
            ['id' => 1, 'name' => 'XXXXX', 'sum' => 0, 'created_at' => "", "items" => []],
        ];

        return $orders;
    }
}