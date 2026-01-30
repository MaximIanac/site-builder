<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class MCatalogVariantProperty extends Model
{
    use HasTranslations;

    public array $translatable = ['value'];
    protected $table = 'm_catalog_product_variant_property';
    protected $guarded = [];
    protected $with = ['property'];
    protected $casts = [
        'value' => 'array'
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(MCatalogVariant::class, 'variant_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(MCatalogProperty::class, 'property_id');
    }
}
