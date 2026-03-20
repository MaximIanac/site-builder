<?php

namespace Maximianac\SiteBuilder\Services\Content\Resources;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Content\Data\CBlockEntryData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class CBlockSlideResourceData extends Data
{
    public function __construct(
        public int $order,

        #[DataCollectionOf(CBlockEntryResourceData::class)]
        public Collection $entries,

        public int|null $id = null,
    ) {}
}
