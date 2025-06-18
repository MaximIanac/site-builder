<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Получить путь к шаблону страницы.
     */
    public function getTemplatePath(): string
    {
        return "site-builder::templates.{$this->template}";
    }

    /**
     * Получить метатеги для страницы.
     */
    public function getMetaTags(): array
    {
        return $this->meta ?? [
            'title' => $this->title,
            'description' => '',
            'keywords' => ''
        ];
    }
}
