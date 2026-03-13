<?php

namespace Maximianac\SiteBuilder\Services\Content\Data;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class CBlockEntryData extends Data
{
    public function __construct(
        public string $key,
        public CBlockEntryTypeEnum $type,
        public array|string|null $value,
        public int $order,

        #[DataCollectionOf(CBlockSlideData::class)]
        public Collection $slides,
    ) {}
}
