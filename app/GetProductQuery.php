<?php

declare(strict_types=1);

namespace Example;

use Illuminate\Database\Capsule\Manager as Capsule;
use function Symfony\Component\Clock\now;

final class GetProductQuery extends BaseStoreQuery implements GetProductQueryInterface
{
    private int $id;

    public function Find(int $id): array|null
    {
        $this->id = $id;

        $strategy = strtolower($this->currentStore->name);
        $result = $this->$strategy();

        return $result;
    }

    protected function mysql(): array|null
    {
        // todo use Capsule client or dependency
        $product = Capsule::table('product')
            ->where('id', '=', $this->id)
            ->first();

        return json_decode(json_encode($product), true);
    }

    protected function redis(): array|null
    {
        // todo use phpredis/phpredis package
        return null;

        return [
            'id' => $this->id,
            'name' => 'aaa redis',
            'price' => 50.00,
            'currency' => 'CZK',
            'created_at' => now(),
        ];
    }

    protected function elasticsearch(): array|null
    {
        // todo use elasticsearch-php package
        return [
            'id' => $this->id,
            'name' => 'aaa elasticsearch',
            'price' => 50.00,
            'currency' => 'CZK',
            'created_at' => now(),
        ];
    }
}
