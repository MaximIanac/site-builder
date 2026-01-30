<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product;

use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyUsageTypeEnum;
use Spatie\LaravelData\Data;

class MCatalogProductPropertyData extends Data
{
    public function __construct(
        public int                           $id,
        public string                        $name,
        public string                        $code,
        public string                        $type,
    ) {}
}
