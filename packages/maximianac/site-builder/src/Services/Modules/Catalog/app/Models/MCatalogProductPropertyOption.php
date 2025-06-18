<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MCatalogProductPropertyOption extends Model
{
    protected $table = 'm_catalog_product_property_options';
    protected $guarded = [];

    public function property(): BelongsTo
    {
        return $this->belongsTo(MCatalogProductProperty::class, 'property_id');
    }
}
