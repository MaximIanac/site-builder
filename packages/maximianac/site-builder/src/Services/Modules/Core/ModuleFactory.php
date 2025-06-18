<?php

namespace Maximianac\SiteBuilder\Services\Modules\Core;

use Exception;
use Illuminate\Support\Str;

class ModuleFactory
{
    /**
     * @throws Exception
     */
    public function getModule(string $moduleName): Module
    {
        $moduleName = Str::of($moduleName)->trim()->lower()->value();

        $module = config("site-builder.modules.$moduleName");

        if (class_exists($module)) {
            return app($module);
        }

        throw new Exception("Module'{$moduleName}' does not exist.");
    }
}
