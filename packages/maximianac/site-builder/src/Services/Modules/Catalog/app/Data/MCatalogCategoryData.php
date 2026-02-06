<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\LoadRelation;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class MCatalogCategoryData extends Data
{
    public function __construct(
        public int                   $id,
        public string                $name,
        public string                $slug,
        public ?string               $description,

        #[LoadRelation]
        public MCatalogCategoryData|Optional|null $parent,

        #[DataCollectionOf(MCatalogPropertyData::class)]
        public Collection|Optional|null           $properties,

        #[DataCollectionOf(MCatalogCategoryData::class), MapInputName('allChildren')]
        public Collection|Optional|null           $children,
    ) {}
}
