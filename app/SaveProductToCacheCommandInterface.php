<?php

declare(strict_types=1);

namespace Example;

interface SaveProductToCacheCommandInterface
{
    public function Execute(array $product): void;
}
