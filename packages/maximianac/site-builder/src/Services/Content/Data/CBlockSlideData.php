<?php

namespace Maximianac\SiteBuilder\Services\Content\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class CBlockSlideData extends Data
{
    public function __construct(
        public int $order,

        #[DataCollectionOf(CBlockEntryData::class)]
        public Collection $entries,
    ) {}
}
