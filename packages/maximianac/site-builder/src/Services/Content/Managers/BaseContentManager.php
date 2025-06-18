<?php

namespace Maximianac\SiteBuilder\Services\Content\Managers;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Services\Content\Contracts\ContentManagerInterface;

abstract class BaseContentManager implements ContentManagerInterface
{
    protected Content $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    abstract protected function init(array $fields): ?Collection;
}
