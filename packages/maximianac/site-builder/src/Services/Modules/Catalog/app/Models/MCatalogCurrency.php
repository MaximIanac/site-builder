<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maximianac\SiteBuilder\Models\ContentEntry;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Models\Panel;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\CurrencyEnum;

class MCatalogCurrency extends Model
{
    protected $guarded = [];
    protected $table = 'currencies';

    protected $casts = [
        'code' => CurrencyEnum::class
    ];
}
