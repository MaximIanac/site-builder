<?php

namespace Maximianac\SiteBuilder\Services\Content\Data;

use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class CBlockData extends Data
{
    public function __construct(
        public string $key,

        #[DataCollectionOf(CBlockEntryData::class)]
        public Collection $entries,

        public Optional|bool $is_active = false,
    ) {}
}
