<?php

declare(strict_types=1);

use Example\AnalyticsService;
use Example\AnalyticsServiceInterface;
use Example\Controller\GetOrderDetailController;
use Example\Controller\GetProductDetailController;
use Example\Controller\HomeController;
use Example\DataRepositoryElasticSearch;
use Example\DataRepositoryMySQL;
use Example\DummyOrderService;
use Example\ElasticSearchDriverInterface;
use Example\GetProductQuery;
use Example\SaveProductToCacheCommand;
use Example\SaveProductToCacheCommandInterface;
use Example\StoreDriversEnum;
use Example\MySQLDriverInterface;
use Example\OrderService;
use Example\OrderServiceInterface;
use Example\ProductDetailService;
use League\Container\Container;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use Slim\Factory\AppFactory;

// set timezone for timestamps etc
date_default_timezone_set('UTC');

// Load environment variables
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
//$dotenv->load();
// todo @refactoring do not need this (handled by docker compose)

$container = new Container();
$container->defaultToShared(); // @todo the container will create a new instance, by default..??

AppFactory::setContainer($container);
$app = AppFactory::create();

$container->add(Manager::class, function() {
    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer());
    return $fractal;
});

if (getenv('APP_ENV') === 'testing') {
    $container->add(OrderServiceInterface::class, DummyOrderService::class);
} else {
    $container->add(OrderServiceInterface::class, OrderService::class);
}

$container->add(MySQLDriverInterface::class, DataRepositoryMySQL::class);
$container->add(ElasticSearchDriverInterface::class, DataRepositoryElasticSearch::class);
$container->add(AnalyticsServiceInterface::class,AnalyticsService::class);

$container->add(GetProductQuery::class, fn() =>
    new GetProductQuery(
        $container->get(MySQLDriverInterface::class),
        $container->get(ElasticSearchDriverInterface::class),
    )
)->setShared(false); // todo @refactoring do I need to call setShared if this has a callback?

$container->add(SaveProductToCacheCommandInterface::class, fn() =>
    new SaveProductToCacheCommand(
        $container->get(MySQLDriverInterface::class),
        $container->get(ElasticSearchDriverInterface::class)
    )
);

$container->add(ProductDetailService::class, fn() =>
     new ProductDetailService(
        $container->get(MySQLDriverInterface::class),
        $container->get(ElasticSearchDriverInterface::class),
        StoreDriversEnum::MySQL, // todo this could be switched from env
        $container->get(AnalyticsServiceInterface::class),
        $container->get(GetProductQuery::class),
        $container->get(SaveProductToCacheCommandInterface::class),
    )
);

$database = require_once __DIR__ . '/../bootstrap/database.php';

$app->get('/{id}', GetOrderDetailController::class);
$app->get('/products/{id}', GetProductDetailController::class);
$app->get('/', HomeController::class);

return $app;
