<?php

declare(strict_types=1);

namespace Example;

final readonly class ProductDetailService
{
    public function __construct(
        private MySQLDriverInterface         $mySQLDriver,
        private ElasticSearchDriverInterface $elasticSearchDriver,
        private StoreDriversEnum             $mainStoreDriver,
        private AnalyticsServiceInterface    $analyticsService,
        private GetProductQuery              $getProductQuery,
        private SaveProductToCacheCommandInterface $saveProductToCacheCommand,
    ) {}

    public function GetDetail(string $id): array
    {
        $this->analyticsService->IncrementProductDetailAccess((int)$id);

        $product = $this->getProductQuery->UseRedis()->Find((int)$id);

        if ($product != null) {
            return $product;
        }

        // todo depends on the finally switching implementation
        if ($this->mainStoreDriver == StoreDriversEnum::MySQL) {
            //$product = $this->mySQLDriver->FindProduct($id);
            $product = $this->getProductQuery->UseMysql()->Find((int)$id); // todo newer API
        } else {
            //$product = $this->elasticSearchDriver->FindById($id);
            $product = $this->getProductQuery->UseElasticSearch()->Find((int)$id); // todo newer API
        }

        $this->saveProductToCacheCommand->Execute($product);

        return $product;
    }
}
