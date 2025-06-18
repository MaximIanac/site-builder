<?php

namespace Maximianac\SiteBuilder\Data\Content;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maximianac\SiteBuilder\Models\ContentEntry;
use Maximianac\SiteBuilder\Models\Translation;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;
use Spatie\LaravelData\Data;
use stdClass;

class TranslationData extends Data
{
    public function __construct(
        public string    $lang,
        public string    $value,
        public ?stdClass $meta,
    ) {}

    public static function fromModel(Translation $model): self
    {
        return new self(
            lang: $model->lang,
            value: $model->translatable?->type === EntryType::File
                ? Storage::url($model->value)
                : $model->value,
            meta: json_decode($model->meta),
        );
    }
}
