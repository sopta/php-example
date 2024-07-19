<?php

declare(strict_types=1);

namespace Example;

abstract class BaseStoreQuery
{
    public function __construct(
        protected MySQLDriverInterface         $mySQLDriver,
        protected ElasticSearchDriverInterface $elasticSearchDriver
    )
    {
    }

    protected StoreDriversEnum $currentStore;

    public function UseMysql(): self
    {
        $this->currentStore = StoreDriversEnum::MySQL;
        return $this;
    }

    public function UseRedis(): self
    {
        $this->currentStore = StoreDriversEnum::Redis;
        return $this;
    }

    public function UseElasticSearch(): self
    {
        $this->currentStore = StoreDriversEnum::ElasticSearch;
        return $this;
    }

    abstract protected function mysql(): array|null; // todo @refactoring move to interface?

    abstract protected function redis(): array|null;

    abstract protected function elasticsearch(): array|null;
}
