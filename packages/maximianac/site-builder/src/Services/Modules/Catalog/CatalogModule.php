<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog;

use Maximianac\SiteBuilder\Services\Modules\Core\Module;

class CatalogModule extends Module
{
    protected string $name = "catalog";
    protected string $description = "catalog_desc";
    protected string $template_path = "catalog";

    public function getTemplatePath(): string
    {
        return $this->template_path;
    }
}
