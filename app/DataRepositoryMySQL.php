<?php

declare(strict_types=1);

namespace Example;

use Illuminate\Database\Capsule\Manager as Capsule;
use stdClass;

final class DataRepositoryMySQL implements MySQLDriverInterface
{
    public function FindProduct(string $id): stdClass
    {
        $product = Capsule::table('product')
            ->where('id', '=', $id)
            ->first();

        return $product;
    }
}
