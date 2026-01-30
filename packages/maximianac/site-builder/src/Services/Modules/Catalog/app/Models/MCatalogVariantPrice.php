<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maximianac\SiteBuilder\Models\ContentEntry;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Models\Panel;

class MCatalogVariantPrice extends Pivot
{
    protected $guarded = [];
    protected $table = 'm_catalog_product_offer_prices';
    protected $with = [
        'currency',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(MCatalogVariant::class, 'variant_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(MCatalogCurrency::class, 'currency_id');
    }
}
