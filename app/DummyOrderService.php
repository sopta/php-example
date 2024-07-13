<?php

namespace Example;

use stdClass;

final class DummyOrderService implements OrderServiceInterface
{
    public function GetOrderDetail(string $id): stdClass
    {
        $orders = [
            ['id' => 1, 'name' => 'XXXXX', 'sum' => 0, 'created_at' => "", "items" => []],
        ];

        return $orders;
    }

    public function GetAllOrders(): array
    {
        $orders = [
            ['id' => 1, 'name' => 'XXXXX', 'sum' => 0, 'created_at' => "", "items" => []],
        ];

        return $orders;
    }
}