<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\LoadRelation;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\Translatable\HasTranslations;

class MCatalogCategoryData extends Data
{
    public function __construct(
        public int                   $id,
        public string                $name,
        public string                $slug,
        public ?string               $description,

        #[LoadRelation]
        public ?MCatalogCategoryData $parent,

        #[DataCollectionOf(MCatalogProductPropertyData::class)]
        public ?Collection           $properties,

        #[DataCollectionOf(MCatalogCategoryData::class), MapInputName('allChildren')]
        public ?Collection           $children,
        public Optional|array        $translatable,
    ) {}
}
