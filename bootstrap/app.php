<?php

declare(strict_types=1);

use Example\GetOrderDetailController;
use Example\HomeController;
use League\Container\Container;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use Slim\Factory\AppFactory;

$container = new Container();
$container->defaultToShared(); // @todo the container will create a new instance, by default..??

AppFactory::setContainer($container);
$app = AppFactory::create();

$container->add(Manager::class, function () {
    $fractal = new Manager();
    $fractal->setSerializer(new DataArraySerializer());
    return $fractal;
});

$app->get('/{id}', GetOrderDetailController::class);
$app->get('/', HomeController::class);

return $app;
