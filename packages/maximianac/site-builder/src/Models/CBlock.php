<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Utility\Enums\CBlockType;

class CBlock extends Model
{
    protected $table = "cblocks";
    protected $guarded = [];


    protected $casts = [
        'type' => CBlockType::class,
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(CBlockEntry::class);
    }
}
