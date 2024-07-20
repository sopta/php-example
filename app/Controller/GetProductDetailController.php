<?php

declare(strict_types=1);

namespace Example\Controller;

use Example\ProductDetailService;
use Example\ProductDetailTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetProductDetailController
{
    private ProductDetailService $productService;
    private Manager $fractal;

    public function __construct(private ContainerInterface $container)
    {
        $this->productService = $this->container->get(ProductDetailService::class);
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
        $product = $this->productService->GetDetail($args["id"]);

        $resource = new Item($product, new ProductDetailTransformer());
        $data = $this->fractal->createData($resource)->toArray();

        $response->getBody()->write((string)json_encode($data));
        return $response;
    }
}
