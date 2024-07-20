<?php

declare(strict_types=1);

namespace Example\Controller;

use Example\OrderDetailTransformer;
use Example\OrderServiceInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class GetOrderDetailController
{
    private OrderServiceInterface $orderService;
    private Manager $fractal;

    public function __construct(private ContainerInterface $container)
    {
        $this->orderService = $this->container->get(OrderServiceInterface::class);
        $this->fractal = $this->container->get(Manager::class);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array<string> $args
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        $orderDetail = $this->orderService->GetOrderDetail($args['id']);

        $resource = new Item($orderDetail, new OrderDetailTransformer());

        $data = $this->fractal->createData($resource)->toArray();

        $response->getBody()->write((string)json_encode($data));
        return $response;
    }
}
