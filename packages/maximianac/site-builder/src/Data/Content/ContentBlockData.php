<?php

namespace Maximianac\SiteBuilder\Data\Content;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Utility\Enums\ContentType;
use Spatie\LaravelData\Data;

class ContentBlockData extends Data
{
    public function __construct(
        public int $id,
        public string $key,
        public string $title,
        public ContentType $type,

        /** @var Collection<EntriesData> */
        public Collection $entries,

        /** @var Collection<PanelData> */
        public Collection $panels,
    ) {}

    public static function fromModel(Content $content): self
    {
        return new self(
            id: $content->id,
            key: $content->key,
            title: Str::of($content->key)
                ->replaceMatches('/[^a-zA-Z0-9]+/', ' ')
                ->trim()
                ->title(),
            type: ContentType::tryFrom($content->type),
            entries: EntriesData::collect($content->entries),
            panels: PanelData::collect($content->panels),
        );
    }
}
