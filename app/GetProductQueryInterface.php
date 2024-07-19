<?php

declare(strict_types=1);

namespace Example;

interface GetProductQueryInterface
{
    public function Find(int $id): array|null;
}
