<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\CurrencyEnum;

class MCatalogVariant extends Model
{
    protected $table = 'm_catalog_product_variants';
    protected $guarded = [];
    protected $with = [
        'propertyValues',
        'prices',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(MCatalogProduct::class, 'product_id');
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogProperty::class,
            'm_catalog_product_variant_property',
            'variant_id',
            'property_id'
        );
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(MCatalogVariantProperty::class, 'variant_id');
    }

    public function currencies(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogCurrency::class,
            'm_catalog_product_variant_prices',
            'variant_id',
            'currency_id',
        )->withPivot('price');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(MCatalogVariantPrice::class, 'variant_id');
    }

    public function priceForCurrency(CurrencyEnum $currencyCode): ?float
    {
        return $this->currencies
            ->firstWhere('code', $currencyCode)
            ?->pivot
            ?->price;
    }
}
