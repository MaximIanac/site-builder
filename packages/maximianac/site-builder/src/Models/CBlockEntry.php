<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CBlockEntry extends Model
{
    use HasTranslations;

    protected $table = 'cblock_entries';
    protected $guarded = [];

    public function block(): BelongsTo
    {
        return $this->belongsTo(CBlock::class);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
