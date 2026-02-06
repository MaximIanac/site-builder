<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Data\Media\MediaData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogCategoryData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProduct;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MCatalogProductData extends Data
{
    public function __construct(
        public int                  $id,
        public string               $name,

        public string               $slug,
        public MCatalogCategoryData $category,
        public ?string              $short_description,
        public ?string              $description,

        #[MapInputName('thumbnail')]
        public ?Media               $thumbnail,
        public ?MediaCollection     $images,

        #[DataCollectionOf(MCatalogPropertyData::class)]
        public ?Collection          $properties,

        #[DataCollectionOf(MCatalogProductVariantData::class)]
        public ?Collection          $variants,

        public ?array               $translations,
    ) {}
}
