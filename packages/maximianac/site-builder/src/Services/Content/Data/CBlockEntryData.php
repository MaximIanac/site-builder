<?php

namespace Maximianac\SiteBuilder\Services\Content\Data;

use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class CBlockEntryData extends Data
{
    public function __construct(
        public string $key,
        public CBlockEntryTypeEnum $type,
        public array|null $value, // TODO: make DTO for ImageData
        public int $order,

        #[DataCollectionOf(CBlockSlideData::class)]
        public Optional|Collection|array|null $slides,

        public int|null $id = null,
    ) {
        if ($this->type === CBlockEntryTypeEnum::SLIDER) {
            $this->value = null;
        }

        if ($this->type !== CBlockEntryTypeEnum::SLIDER) {
            $this->slides = null;
        }
    }
}
