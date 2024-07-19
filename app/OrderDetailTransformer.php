<?php

declare(strict_types=1);

namespace Example;

use League\Fractal\TransformerAbstract;
use stdClass;

final class OrderDetailTransformer extends TransformerAbstract
{
    /**
     * @param stdClass $order
     * @return array<string, int|string>
     */
    public function transform(stdClass $order): array
    {
        $res = [
            'id' => $order->id,
            'total' => $order->total,
            'currency' => $order->currency,
            'state' => $order->state,
            'createdAt' => $order->created_at,
            'items' => [],
        ];

        if (property_exists($order, 'items')) {
            foreach ($order->items as $item) {
                $res['items'][] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'currency' => $item->currency,
                ];
            }
        }

        return $res;
    }
}
