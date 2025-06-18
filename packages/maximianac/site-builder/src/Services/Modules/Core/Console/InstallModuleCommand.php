<?php

namespace Maximianac\SiteBuilder\Services\Modules\Core\Console;

use Illuminate\Console\Command;

class InstallModuleCommand extends Command
{
    protected $signature = 'module:install {module}';
    protected $description = 'Install a site builder module';

    public function handle(): void
    {
        $moduleName = ctype_lower($this->argument('module'));

        if (!class_exists(config("site-builder.modules.$moduleName"))) {
            $this->error("Module {$moduleName} not found!");
            return;
        }

        $this->call('vendor:publish', [
            '--tag' => "{$moduleName}-module"
        ]);

        $this->info("Module {$moduleName} published successfully!");
    }
}
