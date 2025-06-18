<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maximianac\SiteBuilder\Services\Content\Traits\SyncTranslations;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;

class PanelField extends Model
{
    use SyncTranslations;

    protected $guarded = [];

    protected $casts = [
        'type' => EntryType::class,
    ];

    public function panel(): BelongsTo
    {
        return $this->belongsTo(Panel::class);
    }

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}
