<?php

namespace Maximianac\SiteBuilder\Services\Modules\Core\Template\Contracts;

use Illuminate\Contracts\View\View as ViewContract;

interface TemplateInterface
{
    public function render(string $module, string $template, array $data): ViewContract;
}
