<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class MCatalogCategory extends Model
{
    protected $table = 'm_catalog_categories';
    protected $guarded = [];

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
