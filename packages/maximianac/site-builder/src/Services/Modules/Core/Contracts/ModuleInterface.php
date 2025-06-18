<?php

namespace Maximianac\SiteBuilder\Services\Modules\Core\Contracts;

use stdClass;

interface ModuleInterface
{
    public function getName(): string;
    public function getInfo(): stdClass;
    public function getTemplatePath(): string;
}
