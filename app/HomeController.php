<?php
declare(strict_types=1);

namespace Example;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class HomeController
{
    public function __construct(private ContainerInterface $container)
    {}

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array<string> $args
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        /** @var Manager $fractal */
        $fractal = $this->container->get(Manager::class);

        $resource = new Item((object)[], function(object $obj): array {
            return [
                'version' => 1,
            ];
        });

        $data = $fractal->createData($resource)->toArray();

        $response->getBody()->write((string)json_encode($data));
        return $response;
    }
}
