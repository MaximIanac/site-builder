<?php

namespace Maximianac\SiteBuilder\Services\Content\Resources;

use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class PageResourceData extends Data
{
    public function __construct(
        public string $title,
        public string $slug,
        public bool $is_active,

        #[DataCollectionOf(CBlockResourceData::class)]
        public Collection $cblocks,
        public Optional|array|null $translations,

        public int|null $id = null,
    ) {}
}
