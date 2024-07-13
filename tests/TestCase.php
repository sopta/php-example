<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Psr7\Factory\ServerRequestFactory;

abstract class TestCase extends BaseTestCase
{
    protected App $app;

    protected function get(string $url): ResponseInterface
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', $url);

        return $this->app->handle($request);
    }
}
