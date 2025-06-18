<?php

namespace Maximianac\SiteBuilder\Services\Modules\Core\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Maximianac\SiteBuilder\Models\Module;
use stdClass;

abstract class BaseModuleServiceProvider extends ServiceProvider
{
    protected string $modulePath;
    protected const NAMESPACE = 'sb';

    abstract protected function getModuleName(): string;
    abstract protected function getModuleInfo(): stdClass;

    public function register(): void
    {
        $module = $this->getModuleName();
        $this->modulePath = dirname(__DIR__, 2) . '/' . ucfirst($module);

        $this->publishes([
            "{$this->modulePath}/stubs/resources/views/components" => resource_path("views/components/".static::NAMESPACE."/{$module}/"),
        ], "{$module}-components");

        $this->loadViewsFrom("{$this->modulePath}/stubs/resources/views", "sb-".strtolower($module));
    }

    public function boot(): void
    {
        $this->registerRoutes();
        $this->mapApiRoutes();

//        Module::updateOrCreate(
//            ['name' => $moduleInfo->name],
//            ['desc' => $moduleInfo->desc]
//        );

//        dd(Route::getRoutes());
    }

    protected function registerRoutes(): void
    {
        Route::middleware(['web'])
            ->prefix($this->getRoutePrefix())
            ->name($this->getRouteNamePrefix())
            ->group(function () {
                $this->mapRoutes();
            });

        Route::prefix('api/' . $this->getRoutePrefix())
            ->name('api.' . $this->getRouteNamePrefix())
            ->group(function () {
                $this->mapApiRoutes();
            });
    }

    protected function getRoutePrefix(): string
    {
        return "cp/content/modules/" . strtolower($this->getModuleName());
    }

    protected function getRouteNamePrefix(): string
    {
        return "cp.content.modules." . strtolower($this->getModuleName()) . ".";
    }

//    protected function mapApiRoutes(): void
//    {
//        $apiRoute = $this->modulePath . '/routes/api.php';
//        $cpRoute = $this->modulePath . '/routes/cp_api.php';
//
//        if (file_exists($apiRoute)) {
//            Route::prefix('api')->group($apiRoute);
//        }
//
//        if (file_exists($cpRoute)) {
//            Route::prefix('api/cp')->group($cpRoute);
//        }
//    }

    abstract protected function mapRoutes();
    abstract protected function mapApiRoutes();
}
