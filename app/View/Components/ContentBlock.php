<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Content\Managers\ContentManagerOld;
use Maximianac\SiteBuilder\Services\Content\Managers\DefaultContentManager;
use Maximianac\SiteBuilder\Services\Content\Managers\PanelContentManager;
use Maximianac\SiteBuilder\Utility\Enums\ContentType;

class ContentBlock extends Component
{
    public DefaultContentManager|PanelContentManager $BLOCK;

    /**
     * Create a new component instance.
     */
    public function __construct(int $pageId, string $key, string $type = 'default', string|array $entryKeys = [])
    {
        $this->BLOCK = ContentManagerOld::from(
            Page::findOrFail($pageId),
            $key,
            $type,
            $entryKeys
        )->block();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-block');
    }
}
