<?php

namespace Maximianac\SiteBuilder\Services\Modules;

use Maximianac\SiteBuilder\Services\Modules\Core\Providers\BaseModuleServiceProvider;

class ModuleManager
{
    public function get(string $name): ?BaseModuleServiceProvider
    {
        return config("site-builder.modules.$name.class") ?? null;
    }
}
