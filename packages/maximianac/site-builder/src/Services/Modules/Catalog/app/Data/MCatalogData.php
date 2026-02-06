<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

class MCatalogData extends Data
{
    public function __construct(
        #[DataCollectionOf(MCatalogCategoryData::class)]
        public Collection              $categories,

        #[DataCollectionOf(MCatalogProductData::class)]
        public PaginatedDataCollection $products,
    ) {}
}
