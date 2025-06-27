<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\CurrencyEnum;

class MCatalogProductOffer extends Model
{
    protected $table = 'm_catalog_product_offers';
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
            MCatalogProductProperty::class,
            'm_catalog_product_offer_property_values',
            'offer_id',
            'property_id'
        );
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(MCatalogProductOfferPropertyValue::class, 'offer_id');
    }

    public function currencies(): BelongsToMany
    {
        return $this->belongsToMany(
            MCatalogCurrency::class,
            'm_catalog_product_offer_prices',
            'offer_id',
            'currency_id',
        )->withPivot('price');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(MCatalogOfferPrice::class, 'offer_id');
    }

    public function priceForCurrency(CurrencyEnum $currencyCode): ?float
    {
        return $this->currencies
            ->firstWhere('code', $currencyCode)
            ?->pivot
            ?->price;
    }
}
