<?php

namespace Maximianac\SiteBuilder\Data\Content;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Models\Panel;
use Maximianac\SiteBuilder\Services\Content\Contracts\ContentManagerInterface;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;
use Spatie\LaravelData\Data;

class PanelData extends Data implements ContentManagerInterface
{
    public function __construct(
        public int        $id,
        public string     $order,

        /** @var Collection<EntriesData> */
        public Collection $fields,
        public ?array     $short_view,
    ) {}

    public static function fromModel(Panel $model): self
    {
        $firstField = $model->fields()->with(['translations'])->first();

        return new self(
            id: $model->id,
            order: $model->order,
            fields: PanelFieldsData::collect($model->fields),
            short_view: $firstField
                ? array_filter(ShortViewData::collect(
                    $model->fields
                        ->map(fn ($field) => $field->translations->first())
                        ->all()
                ), fn ($item) => !is_null($item->value))
                : null,
        );
    }

    public function getValue(string $key): ?string
    {
        $field = $this->fields->firstWhere('key', $key);

        if (!$field) return null;

        $targetLang = $field->type === EntryType::File ? 'en' : app()->getLocale();
        $translation = $field->translations->firstWhere('lang', $targetLang);

        if (!$translation) return null;

        return $translation->value;
    }
}
