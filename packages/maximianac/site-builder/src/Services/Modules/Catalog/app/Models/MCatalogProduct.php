<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyOriginEnum;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class MCatalogProduct extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    protected $table = 'm_catalog_products';
    protected $guarded = [];
    protected $with = [
        'media', 'category', 'variants',
    ];
    public array $translatable = ['name', 'short_description', 'description'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogProperty::class,
            'm_catalog_product_property',
            'product_id',
            'property_id'
        )
            ->using(MCatalogProductPropertyPivot::class)
            ->withPivot(['value', 'origin']);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(MCatalogVariant::class, 'product_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MCatalogCategory::class, 'category_id');
    }

    public function scopeInCategoryWithChildren($query, MCatalogCategory $category)
    {
        $categoryIds = collect([$category->id])
            ->merge($category->getAllChildCategories()->pluck('id'));

        return $query->whereIn('category_id', $categoryIds);
    }

    public function getImagesAttribute(): MediaCollection
    {
        return $this->getMedia('images');
    }

    public function getThumbnailAttribute(): ?Media
    {
        return $this->images->firstWhere('order_column', '=', 1);
    }
}
