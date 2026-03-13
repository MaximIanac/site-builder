<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\Translatable\HasTranslations;

class CBlockEntry extends Model
{
    use HasTranslations;

    protected $table = 'cblock_entries';
    protected $guarded = [];
    protected array $translatable = ['value'];
    protected $with = ['slides'];

    protected $casts = [
        'type' => CBlockEntryTypeEnum::class,
    ];

    public function cblock(): BelongsTo
    {
        return $this->belongsTo(CBlock::class);
    }

    public function slides(): HasMany
    {
        return $this->hasMany(CBlockSlide::class, 'cblock_entry_id');
    }

    public function scopeOfType($query, CBlockEntryTypeEnum $type)
    {
        return $query->where('type', $type);
    }
}
