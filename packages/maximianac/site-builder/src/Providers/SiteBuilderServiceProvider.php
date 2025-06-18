<?php

namespace Maximianac\SiteBuilder\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Services\Modules\ModuleManager;
use Maximianac\SiteBuilder\Services\Utils\UtilsServiceProvider;

class SiteBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UtilsServiceProvider::class);

        $this->mergeConfigFrom(
            dirname(__DIR__, 2) . '/config/site-builder.php',
            'site-builder'
        );

        $this->loadViewsFrom(
            dirname(__DIR__, 2) . "/stubs/resources/views",
            "sb"
        );

        $this->app->singleton(ModuleManager::class, fn () =>
            new ModuleManager()
        );

        $modulesPath = dirname(__DIR__) . '\\' . config('site-builder.modules_path');

        if (!is_dir($modulesPath)) {
            return;
        }

        foreach (scandir($modulesPath) as $moduleName) {
            if ($moduleName === '.' || $moduleName === '..') continue;

            $providerClass = "Maximianac\\SiteBuilder\\Services\\Modules\\{$moduleName}\\{$moduleName}ServiceProvider";

            if (class_exists($providerClass)) {
                $this->app->register($providerClass);
            }
        }
    }

    public function boot(): void
    {
        $this->getCurrentPage();

        $this->publishes([
            dirname(__DIR__, 2) . '/config/site-builder.php' => config_path('site-builder.php'),
        ], 'site-builder-config');

        $this->commands([
            \Maximianac\SiteBuilder\Services\Modules\Core\Console\InstallModuleCommand::class,
        ]);
    }

    protected function getCurrentPage(): void
    {
        $this->app->bind('page', function ($app) {
            return once(function () use ($app) {
                return $app['request']
                    ? Page::where('slug', $app['request']->path())->first()
                    : null;
            });
        });

        View::composer('*', function ($view) {
            if (!array_key_exists('page', $view->getData())) {
                $view->with('page', app('page'));
            }
        });
    }
}
