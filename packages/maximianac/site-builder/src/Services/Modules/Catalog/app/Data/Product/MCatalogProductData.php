<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogCategoryData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class MCatalogProductData extends Data
{
    public function __construct(
        public int                  $id,
        public string               $name,
        public string               $slug,
        public MCatalogCategoryData $category,
        public ?string              $short_description,
        public ?string              $description,
        public ?string              $main_image,
//
//        #[DataCollectionOf(MCatalogProductPropertyData::class), MapInputName('propertyValues.property')]
//        public ?Collection          $properties,
        #[DataCollectionOf(MCatalogProductPropertyValueData::class)]
        public ?Collection          $propertyValues,
        #[DataCollectionOf(MCatalogProductOffersData::class)]
        public ?Collection          $offers,
    ) {}
}
