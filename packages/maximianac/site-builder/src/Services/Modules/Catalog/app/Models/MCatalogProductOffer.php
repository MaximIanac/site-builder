<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class MCatalogProductOffer extends Model
{
    protected $table = 'm_catalog_product_offers';
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(MCatalogProduct::class, 'product_id');
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(MCatalogProductOfferPropertyValue::class, 'offer_id');
    }

//    public function getPropertys(): Collection
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
