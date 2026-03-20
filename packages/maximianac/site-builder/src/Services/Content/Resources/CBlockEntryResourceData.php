<?php

namespace Maximianac\SiteBuilder\Services\Content\Resources;

use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class CBlockEntryResourceData extends Data
{
    public function __construct(
        public string $key,
        public CBlockEntryTypeEnum $type,
        public string|null $value,
        public int $order,

        #[DataCollectionOf(CBlockSlideResourceData::class)]
        public Optional|Collection|null $slides,

        public array|null $translations,

        public int|null $id = null,

    ) {
        if ($this->type === CBlockEntryTypeEnum::SLIDER) {
            $this->value = null;
            $this->translations = null;
        }

        if ($this->type !== CBlockEntryTypeEnum::SLIDER) {
            $this->slides = null;
        }

        if ($this->slides instanceof Collection) {
            $this->slides = CBlockSlideResourceData::collect($this->slides);
        }
    }
}
