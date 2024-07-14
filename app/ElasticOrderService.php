<?php

declare(strict_types=1);

namespace Example;

use stdClass;

final class ElasticOrderService implements OrderServiceInterface
{
    public function GetOrderDetail(string $id): stdClass
    {
        // TODO: Implement GetOrderDetail() method.
        return new stdClass();
    }

    public function GetAllOrders(): array
    {
        // TODO: Implement GetAllOrders() method.
        return [];
    }
}