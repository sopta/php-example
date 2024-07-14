<?php

declare(strict_types=1);

namespace Example;

use League\Fractal\TransformerAbstract;
use stdClass;

final class OrderDetailTransformer extends TransformerAbstract
{
    /**
     * @param stdClass $user
     * @return array<string, int|string>
     */
    public function transform(stdClass $user): array
    {
        $res = [
            'id' => $user->id,
            'total' => $user->total,
            'currency' => $user->currency,
            'state' => $user->state,
            'createdAt' => $user->created_at,
            'items' => [],
        ];

        if (property_exists($user, 'items')) {
            foreach ($user->items as $item) {
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
