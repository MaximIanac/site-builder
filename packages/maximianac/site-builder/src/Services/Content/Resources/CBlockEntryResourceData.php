<?php

namespace Maximianac\SiteBuilder\Services\Content\Resources;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CBlockEntryResourceData extends Data
{
    public function __construct(
        public string $key,
        public CBlockEntryTypeEnum $type,
        public Optional|string|null $value,
        public int $order,
        public Optional|Media $image,

        #[DataCollectionOf(CBlockSlideResourceData::class)]
        public Optional|Collection $slides,

        public Optional|array|null $translations,

        public int|null $id = null,

    ) {
        if ($this->type === CBlockEntryTypeEnum::SLIDER || $this->type === CBlockEntryTypeEnum::IMAGE) {
            $this->value = Optional::create();
            $this->translations = Optional::create();
        }

        if ($this->type !== CBlockEntryTypeEnum::SLIDER) {
            $this->slides = Optional::create();
        }

        if ($this->type !== CBlockEntryTypeEnum::IMAGE) {
            $this->image = Optional::create();
        }

        if ($this->slides instanceof Collection) {
            $this->slides = CBlockSlideResourceData::collect($this->slides);
        }
    }
}
