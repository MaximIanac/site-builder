<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class MCatalogProduct extends Model
{
    protected $table = 'm_catalog_products';
    protected $guarded = [];
    protected $casts = [
        'images' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MCatalogCategory::class, 'category_id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(MCatalogProductOffer::class, 'product_id');
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(MCatalogProductPropertyValue::class, 'product_id');
    }

    public function scopeInCategoryWithChildren($query, MCatalogCategory $category)
    {
        $categoryIds = collect([$category->id])
            ->merge($category->getAllChildCategories()->pluck('id'));

        return $query->whereIn('category_id', $categoryIds);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

//    public function getProperties(): Collection
//    {
//        return $this->propertyValues()->get()->mapWithKeys(function ($item) {
//            return [$item->property->code => $item->value];
//        });
//    }

//    public function getPropertyValue(string $key): ?string
//    {
//        return optional(
//            $this->propertyValues()->get()->firstWhere('property.code', $key)
//        )
//            ->value;
//    }
}
