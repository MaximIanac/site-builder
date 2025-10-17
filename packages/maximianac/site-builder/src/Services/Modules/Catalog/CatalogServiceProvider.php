<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog;

use Illuminate\Support\Facades\Route;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController;
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
        Route::get('/', [MCatalogController::class, 'index'])->name('index');
        Route::resource('categories', MCatalogCategoryController::class);
        Route::resource('products', MCatalogProductController::class);
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('categories')->name('categories.')
            ->group(function () {
                Route::get('parentProperties', [MCatalogCategoryApiController::class, 'getCategoryParentProperties'])->name('parentProperties');
                Route::get('childCategories', [MCatalogCategoryApiController::class, 'getAllChildCategories'])->name('childCategories');
            }
        );

        Route::prefix('properties')->name('properties.')
            ->group(function () {
                Route::resource('/', MCatalogPropertyApiController::class)->only('store');
            }
        );
    }
}
