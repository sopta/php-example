<?php

declare(strict_types=1);

namespace Example;

final class SaveProductToCacheCommand extends BaseStoreQuery implements SaveProductToCacheCommandInterface
{
    public function __construct(MySQLDriverInterface $mySQLDriver, ElasticSearchDriverInterface $elasticSearchDriver)
    {
        parent::__construct($mySQLDriver, $elasticSearchDriver);
        $this->UseRedis();
    }

    public function Execute(array $product): void
    {
    }

    protected function mysql(): array|null
    {
        return null;
    }

    protected function redis(): array|null
    {
        return null;
    }

    protected function elasticsearch(): array|null
    {
       return null;
    }
}