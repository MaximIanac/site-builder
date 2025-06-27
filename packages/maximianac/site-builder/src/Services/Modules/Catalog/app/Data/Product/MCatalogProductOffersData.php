<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class MCatalogProductOffersData extends Data
{
    public function __construct(
        public int                           $id,
        public string                        $sku,

        #[DataCollectionOf(MCatalogProductOfferPriceData::class)]
        public Collection                    $prices,
        public int                           $quantity,

        #[DataCollectionOf(MCatalogProductPropertyValueData::class)]
        public Collection                    $propertyValues,
    ) {}
}
