<?php

declare(strict_types=1);

namespace Example;

use stdClass;

final class DataRepositoryElasticSearch implements ElasticSearchDriverInterface
{
    public function FindById(string $id): stdClass
    {
        return new stdClass();
    }
}
