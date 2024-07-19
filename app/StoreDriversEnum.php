<?php

declare(strict_types=1);

namespace Example;

enum StoreDriversEnum
{
    case MySQL;
    case ElasticSearch;
    case File;
    case Redis;
    case PlanetScale;
}
