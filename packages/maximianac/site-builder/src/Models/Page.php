<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations, SoftDeletes;

    protected $guarded = [];
    protected array $translatable = ['title'];
    protected $with = ['cblocks'];

    public function cblocks(): HasMany
    {
        return $this->hasMany(CBlock::class);
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
