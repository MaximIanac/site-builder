<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\Translatable\HasTranslations;

class CBlockSlideEntry extends Model
{
    use HasTranslations;

    protected $table = 'cblock_slide_entries';
    protected $guarded = [];
    protected array $translatable = ['value'];

    protected $casts = [
        'type' => CBlockEntryTypeEnum::class,
    ];

    public function cblockSlide(): BelongsTo
    {
        return $this->belongsTo(CBlockSlide::class);
    }

    public function scopeOfType($query, CBlockEntryTypeEnum $type)
    {
        return $query->where('type', $type);
    }
}
