<?php

namespace Maximianac\SiteBuilder\Services\Content\Contracts;

interface ContentManagerInterface
{
    public function getValue(string $key): mixed;
}
