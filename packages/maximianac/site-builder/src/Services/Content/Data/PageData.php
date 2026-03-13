<?php

namespace Maximianac\SiteBuilder\Services\Content\Data;

use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class PageData extends Data
{
    public function __construct(
        public string|array $title,
        public string $slug,
        public bool $is_active,

        #[DataCollectionOf(CBlockData::class)]
        public Collection $cblocks,

        public int|null $id = null,
    ) {}
}
