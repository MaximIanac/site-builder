<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\Translatable\HasTranslations;

class CBlockSlide extends Model
{
    protected $table = 'cblock_slides';
    protected $guarded = [];
    protected $with = ['entries'];

    public function cblockEntry(): BelongsTo
    {
        return $this->belongsTo(CBlockEntry::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(CBlockSlideEntry::class, 'cblock_slide_id');
    }
}
