<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\Translatable\HasTranslations;

class MCatalogCategory extends Model
{
    use HasTranslations;

    protected $table = 'm_catalog_categories';
    protected $guarded = [];

    public array $translatable = ['name', 'description'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MCatalogCategory::class, 'parent_id');
    }

    public function getAllParentCategories(): Collection
    {
        $categories = collect([$this]);

        $parent = $this->parent;

        while ($parent) {
            $categories->push($parent);
            $parent = $parent->parent;
        }

        return $categories;
    }

    public function getAllChildCategories(): Collection
    {
        $categories = collect();
        $currentLevel = $this->children;

        while ($currentLevel->isNotEmpty()) {
            $currentLevel = $currentLevel->map(fn($item) => new MCatalogCategory($item->toArray()));

            $categories = $categories->merge($currentLevel);
            $currentLevel = $currentLevel->flatMap->children;
        }

        return $categories->unique('id');
    }

    public function getAllProductsIncludingChildren()
    {
        $categoryIds = collect([$this->id])
            ->merge($this->getAllChildCategories()->pluck('id'));

        return MCatalogProduct::whereIn('category_id', $categoryIds)->get();
    }

    public function children(): HasMany
    {
        return $this->hasMany(MCatalogCategory::class, 'parent_id');
    }

    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren');
    }

    public function products(): HasMany
    {
        return $this->hasMany(MCatalogProduct::class, 'category_id');
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogProductProperty::class,
            'm_catalog_category_product_property',
            'category_id',
            'property_id'
        );
    }
}
