<?php

namespace Maximianac\SiteBuilder\Data\Content;

use Illuminate\Support\Facades\Storage;
use Maximianac\SiteBuilder\Models\Translation;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;
use Spatie\LaravelData\Data;

class ShortViewData extends Data
{
    public function __construct(
        public ?string    $lang,
        public ?EntryType $type,
        public ?string    $value,
    ) {}

    public static function fromModel(Translation $model): self
    {
        return new self(
            lang: $model->lang,
            type: $model->translatable->type,
            value: $model->translatable->type === EntryType::File
                ? Storage::url($model->value)
                : $model->value,
        );
    }
}
