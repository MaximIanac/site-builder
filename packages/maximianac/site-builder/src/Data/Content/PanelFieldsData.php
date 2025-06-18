<?php

namespace Maximianac\SiteBuilder\Data\Content;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maximianac\SiteBuilder\Models\ContentEntry;
use Maximianac\SiteBuilder\Models\PanelField;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;
use Spatie\LaravelData\Data;

class PanelFieldsData extends Data
{
    public function __construct(
        public string     $key,
        public EntryType  $type,
        public string     $title,

        /** @var Collection<TranslationData> */
        public Collection $translations,
    ) {}

    public static function fromModel(PanelField $model): self
    {
        return new self(
            key: $model->key,
            type: $model->type,
            title: Str::of($model->key)
                ->replaceMatches('/[^a-zA-Z]+/', ' ')
                ->trim()
                ->title(),
            translations: TranslationData::collect($model->translations)
        );
    }
}
