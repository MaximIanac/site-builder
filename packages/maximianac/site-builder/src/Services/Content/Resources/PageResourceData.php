<?php

namespace Maximianac\SiteBuilder\Services\Content\Resources;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PageResourceData extends Data
{
    public function __construct(
        public string $title,
        public string $slug,
        public bool $is_active,

        #[DataCollectionOf(CBlockResourceData::class)]
        public Optional|Collection $cblocks,
        public Optional|array|null $translations,

        public int|null $id = null,
    ) {}
}
