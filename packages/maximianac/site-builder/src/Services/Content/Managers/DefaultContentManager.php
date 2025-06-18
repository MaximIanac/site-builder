<?php

namespace Maximianac\SiteBuilder\Services\Content\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Models\ContentEntry;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;

class DefaultContentManager extends BaseContentManager
{
    /** @var Collection<ContentEntry> */
    private Collection $entries;

    public function __construct(Content $content, ?array $entryKeys = null)
    {
        parent::__construct($content);

        if ($entryKeys) {
            $this->entries = $this->init($entryKeys);
        }
    }

    public function getValue(string $key): ?string
    {
        $entry = $this->entries->firstWhere('key', '=', $key);
        $lang = App::getLocale();

        $targetLang = $entry->type === EntryType::File ? 'en' : $lang;

        $translation = $entry->translations()->where('lang', $targetLang)->first();

        if (!$translation) {
            return null;
        }

        return match ($entry->type) {
            EntryType::File => Storage::url($translation->value),

            default => $translation->value,
        };
    }

    protected function init(array $fields): Collection
    {
        return collect($fields)->map(function ($item){
            if (is_string($item)) {
                return $this->content->entries()->updateOrCreate(['key' => $item]);
            }

            if (is_array($item) && isset($item['key'])) {
                return $this->content->entries()->updateOrCreate(
                    ['key' => $item['key']],
                    ['type' => $item['type'] ?? 'text']
                );
            }

            throw new InvalidArgumentException("Invalid entry key format: " . json_encode($item));
        })->filter();
    }
}
