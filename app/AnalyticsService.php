<?php

declare(strict_types=1);

namespace Example;

final class AnalyticsService implements AnalyticsServiceInterface
{
    public function IncrementProductDetailAccess(int $id): void
    {
        // todo increment counter.. different driver/query
    }
}
