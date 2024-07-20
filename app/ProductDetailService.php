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

        // $product = $this->mySQLDriver->FindProduct($id);
        // $product = $this->elasticSearchDriver->FindById($id);

        // todo depends on the finally switching implementation
        // todo $this->db->Execute($this->getProductQuery->UseMysql()->Find((int)$id))

        $product = $this->mainStoreDriver == StoreDriversEnum::MySQL
            ? $this->getProductQuery->UseMysql()->Find((int)$id)
            : $this->getProductQuery->UseElasticSearch()->Find((int)$id);

        $this->saveProductToCacheCommand->Execute($product);

        return $product;
    }
}
