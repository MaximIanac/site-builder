<?php

namespace Maximianac\SiteBuilder\Services\Content\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Maximianac\SiteBuilder\Data\Content\PanelData;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Models\Panel;
use Maximianac\SiteBuilder\Services\Content\Contracts\PanelManagerInterface;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;

class PanelContentManager extends BaseContentManager implements PanelManagerInterface
{
    /** @var Collection<PanelData> */
    protected Collection $panels;
    protected Panel $initPanel;

    public function __construct(Content $content, ?array $initFields = null)
    {
        parent::__construct($content);

        $this->panels = PanelData::collect($this->content->panels);

        if ($initFields) {
            $this->initPanel = $this->content->panels()->updateOrCreate(['order' => 0]);
            $this->init($initFields);
        }
    }

    public function getPanels(): Collection
    {
        return $this->panels;
    }

    public function getValue(string $key, int $order = 0): ?string
    {
        $panel = $this->panels->firstWhere('order', '=', $order);
        $field = $panel?->fields->firstWhere('key', $key);

        $targetLang = $field->type === EntryType::File ? 'en' : App::getLocale();

        $translation = $field->translations->firstWhere('lang', $targetLang);

        if (!$translation) return null;

        return $translation->value;
    }

    protected function init(array $fields): ?Collection
    {
        return collect($fields)->map(function ($item){
            if (is_string($item)) {
                return $this->initPanel->fields()->updateOrCreate(['key' => $item]);
            }

            if (is_array($item) && isset($item['key'])) {
                return $this->initPanel->fields()->updateOrCreate(
                    ['key' => $item['key']],
                    ['type' => $item['type'] ?? 'text']
                );
            }

            throw new InvalidArgumentException("Invalid entry key format: " . json_encode($item));
        })->filter();
    }
}
