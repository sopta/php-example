<?php

declare(strict_types=1);

namespace Example;

use Illuminate\Database\Capsule\Manager as Capsule;
use stdClass;

final class OrderService implements OrderServiceInterface
{
    public function GetOrderDetail(string $id): stdClass
    {
        return Capsule::table('order')->where('id', '=', $id)->first();
    }

    public function GetAllOrders(): array
    {
        return Capsule::table('order')->get()->all();
    }
}
