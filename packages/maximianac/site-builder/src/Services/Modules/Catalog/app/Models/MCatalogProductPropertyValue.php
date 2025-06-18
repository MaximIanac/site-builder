<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MCatalogProductPropertyValue extends Model
{
    protected $table = 'm_catalog_product_property_values';
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(MCatalogProduct::class, 'product_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(MCatalogProductProperty::class, 'property_id');
    }

//    public function getValueProperty($value): float|bool|int
//    {
//        return match ($this->property->type) {
//            'integer' => (int)$value,
//            'float' => (float)$value,
//            'boolean' => (bool)$value,
//            default => $value
//        };
//    }
}
