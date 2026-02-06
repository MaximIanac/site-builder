<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Translatable\HasTranslations;

class MCatalogProductPropertyPivot extends Pivot
{
    use HasTranslations;

    public array $translatable = ['value'];
    protected $table = 'm_catalog_product_property';
    protected $guarded = [];
    protected $with = [
        'property',
    ];
    protected $casts = [
        'value' => 'array'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(MCatalogProduct::class, 'product_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(MCatalogProperty::class, 'property_id');
    }
}
