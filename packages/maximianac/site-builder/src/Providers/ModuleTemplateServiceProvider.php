<?php

namespace Maximianac\SiteBuilder\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ModuleTemplateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('module-template', \Maximianac\SiteBuilder\Services\Modules\Core\Template\TemplateService::class);
    }

    public function boot(): void
    {
        Blade::directive('module', function ($expression) {
            return "<?php echo ModuleTemplate::render(...explode('.', {$expression}, 2)); ?>";
        });
    }
}
