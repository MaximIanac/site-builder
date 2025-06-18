<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MCatalogProductProperty extends Model
{
    protected $table = 'm_catalog_product_properties';
    protected $guarded = [];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogCategory::class,
            'm_catalog_category_product_property',
            'property_id',
            'category_id'
        );
    }

    public function options(): HasMany
    {
        return $this->hasMany(MCatalogProductPropertyOption::class, 'property_id');
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
