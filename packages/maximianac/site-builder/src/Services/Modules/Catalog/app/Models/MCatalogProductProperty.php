<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyUsageTypeEnum;

class MCatalogProductProperty extends Model
{
    protected $table = 'm_catalog_product_properties';
    protected $guarded = [];
    protected $casts = [
        'usage_type' => PropertyUsageTypeEnum::class
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogCategory::class,
            'm_catalog_category_product_property',
            'property_id',
            'category_id'
        );
    }

    public function scopeForOffer($query)
    {
        return $query->where('usage_type', PropertyUsageTypeEnum::OFFER);
    }

    public function scopeForCategory($query)
    {
        return $query->where('usage_type', PropertyUsageTypeEnum::CATEGORY);
    }

    public function productValues(): HasMany
    {
        return $this->hasMany(MCatalogProductPropertyValue::class, 'property_id');
    }

    public function offerValues(): HasMany
    {
        return $this->hasMany(MCatalogProductOfferPropertyValue::class, 'property_id');
    }
}
