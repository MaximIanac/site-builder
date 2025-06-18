<?php

namespace Maximianac\SiteBuilder\Services\Content\Contracts;

use Illuminate\Support\Collection;

interface PanelManagerInterface
{
    public function getPanels(): Collection;
}
