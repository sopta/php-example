<?php

declare(strict_types=1);

namespace Example;

use stdClass;

interface ElasticSearchDriverInterface
{
    public function FindById(string $id): stdClass;
}
