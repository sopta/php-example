<?php
declare(strict_types=1);

namespace Example;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class GetOrderDetailController
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

        $users = [
            ['id' => 1, 'name' => 'John Doe', 'sum' => 1000.00, 'created_at' => "2024", "items" => []],
            ['id' => 2, 'name' => 'John Doe 2', 'sum' => 1000.00, 'created_at' => "2024", "items" => []],
        ];

        $resource = new Collection($users, new OrderDetailTransformer());
        $data = $fractal->createData($resource)->toArray();

        $response->getBody()->write((string)json_encode($data));
        return $response;
    }
}
