<?php

declare(strict_types=1);

namespace Example;

interface AnalyticsServiceInterface
{
    public function IncrementProductDetailAccess(int $id): void;
}
