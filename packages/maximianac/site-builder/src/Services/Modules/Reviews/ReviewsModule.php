<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews;

use Maximianac\SiteBuilder\Services\Modules\Core\Module;

class ReviewsModule extends Module
{
    protected string $name = "reviews";
    protected string $description = "Test desc";
    protected string $template_path = "reviews";

    public function getTemplatePath(): string
    {
        return $this->template_path;
    }
}
