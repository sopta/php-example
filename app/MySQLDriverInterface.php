<?php

declare(strict_types=1);

namespace Example;

use stdClass;

interface MySQLDriverInterface
{
    public function FindProduct(string $id): stdClass;
}
