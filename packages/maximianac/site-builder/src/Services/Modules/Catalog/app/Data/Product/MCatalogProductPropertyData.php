<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product;

use Spatie\LaravelData\Data;

class MCatalogProductPropertyData extends Data
{
    public function __construct(
        public int                           $id,
        public string                        $name,
        public string                        $code,
        public string                        $type,
        public bool                          $is_required,
    ) {}
}
