<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews;

use Maximianac\SiteBuilder\Services\Modules\Core\Providers\BaseModuleServiceProvider;
use stdClass;

class ReviewsServiceProvider extends BaseModuleServiceProvider
{
    protected function getModuleName(): string
    {
        return (new ReviewsModule())->getName();
    }

    protected function getModuleInfo(): stdClass
    {
        return (new ReviewsModule())->getInfo();
    }

    protected function mapRoutes()
    {
        // TODO: Implement mapRoutes() method.
    }

    protected function mapApiRoutes()
    {
        // TODO: Implement mapApiRoutes() method.
    }
}
