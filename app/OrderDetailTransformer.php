<?php
declare(strict_types=1);

namespace Example;

use League\Fractal\TransformerAbstract;

final class OrderDetailTransformer extends TransformerAbstract
{
    /**
     * @param array<string, int|string> $user
     * @return array<string, int|string>
     */
    public function transform(array $user): array
    {
        return [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'sum' => $user['sum'],
            'createdAt' => $user['sum'],
            'items' => $user['items'],
        ];
    }
}
