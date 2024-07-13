<?php

declare(strict_types=1);

namespace Example;

use stdClass;

interface OrderServiceInterface
{
    public function GetOrderDetail(string $id): stdClass;
    public function GetAllOrders(): array;
}
