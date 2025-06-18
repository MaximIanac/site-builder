<?php

namespace Maximianac\SiteBuilder\Services\Modules\Core;

use Maximianac\SiteBuilder\Services\Modules\Core\Contracts\ModuleInterface;
use stdClass;

abstract class Module implements ModuleInterface
{
    protected string $template_path;
    protected string $name;
    protected string $description;
    protected string $version = '1.0.0';

    public function getName(): string
    {
        return $this->name;
    }

    public function getInfo(): stdClass
    {
        return (object) [
            'name' => $this->name,
            'desc' => $this->description,
            'template' =>$this->template_path,
        ];
    }
}
