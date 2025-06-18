<?php

namespace Maximianac\SiteBuilder\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Contracts\View\View render(string $moduleTemplate, array $data = [])
 */
class ModuleTemplate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'module-template';
    }
}
