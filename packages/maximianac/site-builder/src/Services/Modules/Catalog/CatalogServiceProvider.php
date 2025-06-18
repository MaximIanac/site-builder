<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog;

use Illuminate\Support\Facades\Route;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController;
use Maximianac\SiteBuilder\Services\Modules\Core\Providers\BaseModuleServiceProvider;
use stdClass;

class CatalogServiceProvider extends BaseModuleServiceProvider
{
    protected function getModuleName(): string
    {
        return (new CatalogModule())->getName();
    }

    protected function getModuleInfo(): stdClass
    {
        return (new CatalogModule())->getInfo();
    }

    protected function mapRoutes(): void
    {
        Route::resource('category', MCatalogCategoryController::class);
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('category')->name('category.')
            ->group(function () {
                Route::get('parentProperties', [MCatalogCategoryApiController::class, 'getCategoryParentProperties'])->name('parentProperties');
            }
        );

        Route::prefix('property')->name('property.')
            ->group(function () {
                Route::resource('/', MCatalogPropertyApiController::class)->only('store');
            }
        );
    }
}
