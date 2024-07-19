<?php

declare(strict_types=1);

namespace Example;

use League\Fractal\TransformerAbstract;
use stdClass;

final class ProductDetailTransformer extends TransformerAbstract
{
    /**
     * @param array $product
     * @return array<string, int|string>
     */
    public function transform(array $product): array
    {
        /*
        $res = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'currency' => $product->currency,
            'createdAt' => $product->created_at,
        ];

       */

        $res = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'currency' => $product['currency'],
            'createdAt' => $product['created_at'],
        ];

        return $res;
    }
}
