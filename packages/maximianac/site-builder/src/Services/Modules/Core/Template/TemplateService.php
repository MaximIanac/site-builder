<?php

namespace Maximianac\SiteBuilder\Services\Modules\Core\Template;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Maximianac\SiteBuilder\Services\Modules\Core\Template\Contracts\TemplateInterface;

class TemplateService implements TemplateInterface
{
    public function render(string $module, string $template, array $data): ViewContract
    {
        $path = $this->resolvePath($module, $template);

        if (!View::exists($path)) {
            throw new \InvalidArgumentException("Module template [{$module}::{$template}] not found");
        }

        return view($path, $data);
    }

    /**
     * Формирует путь к шаблону.
     */
    protected function resolvePath(string $module, string $template): string
    {
        $templatePath = str_replace('.', '/', $template);

        return "modules/{$module}/{$templatePath}.blade.php";
    }

    /**
     * Gets all page templates from resources/views/pages
     *
     * @return array
     */
    public static function getPageTemplates(): array
    {
        $path = resource_path('views/pages');
        $templates = [];

        if (File::exists($path)) {
            foreach (File::directories($path) as $directory) {
                $folderName = basename($directory);

                $files = collect(File::files($directory))
                    ->map(fn($file) => Str::replaceLast('.blade.php', '', $file->getFilename()))
                    ->toArray();

                $templates[] = [
                    'name' => ucfirst($folderName),
                    'value' => $folderName,
                    'templates' => $files,
                ];
            }
        }

        return $templates;
    }
}
