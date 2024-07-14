<?php

declare(strict_types=1);

use Example\DummyOrderService;
use Example\GetOrderDetailController;
use Example\HomeController;
use Example\OrderService;
use Example\OrderServiceInterface;
use League\Container\Container;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use Slim\Factory\AppFactory;

// set timezone for timestamps etc
date_default_timezone_set('UTC');

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
$container->defaultToShared(); // @todo the container will create a new instance, by default..??

AppFactory::setContainer($container);
$app = AppFactory::create();

$container->add(Manager::class, function () {
    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer());
    return $fractal;
});

if (getenv('APP_ENV') === 'testing') {
    $container->add(OrderServiceInterface::class, DummyOrderService::class);
} else {
    $container->add(OrderServiceInterface::class, OrderService::class);
}

$database = require_once __DIR__ . '/../bootstrap/database.php';

$app->get('/{id}', GetOrderDetailController::class);
$app->get('/', HomeController::class);

return $app;
