<?php

namespace Maximianac\SiteBuilder\Services\Content\Resources;

use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class CBlockResourceData extends Data
{
    public function __construct(
        public string $key,

        #[DataCollectionOf(CBlockEntryResourceData::class)]
        public Collection $entries,

        public Optional|bool $is_active = false,
        public int|null $id = null,
    ) {}
}
