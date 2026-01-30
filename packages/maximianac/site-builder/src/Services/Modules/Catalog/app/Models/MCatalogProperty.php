<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyUsageTypeEnum;
use Spatie\Translatable\HasTranslations;

class MCatalogProperty extends Model
{
    use HasTranslations;

    protected $table = 'm_catalog_properties';
    protected $guarded = [];

    public array $translatable = ['name'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogCategory::class,
            'm_catalog_category_property',
            'property_id',
            'category_id'
        );
    }

    public function scopeForVariant($query)
    {
        return $query->where('usage_type', PropertyUsageTypeEnum::VARIANT);
    }

    public function scopeForCategory($query)
    {
        return $query->where('usage_type', PropertyUsageTypeEnum::CATEGORY);
    }

    public function productValues(): HasMany
    {
        return $this->hasMany(MCatalogProductProperty::class, 'property_id');
    }

    public function offerValues(): HasMany
    {
        return $this->hasMany(MCatalogVariantProperty::class, 'property_id');
    }
}
