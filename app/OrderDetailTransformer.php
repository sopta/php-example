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
        return [
            'id' => (int) $user->id,
            'price' => $user->price,
            'currency' => $user->currency,
            'state' => $user->state,
            'createdAt' => $user->created_at,
            //'items' => $user->items,
        ];
    }
}
