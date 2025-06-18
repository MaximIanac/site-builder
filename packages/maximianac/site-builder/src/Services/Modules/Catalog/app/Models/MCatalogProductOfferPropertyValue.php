<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MCatalogProductOfferPropertyValue extends Model
{
    protected $table = 'm_catalog_product_offer_property_values';
    protected $guarded = [];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(MCatalogProductOffer::class, 'offer_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(MCatalogProductProperty::class, 'property_id');
    }
}
