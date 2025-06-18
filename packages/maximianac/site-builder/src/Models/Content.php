<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(ContentEntry::class);
    }

    public function panels(): HasMany
    {
        return $this->hasMany(Panel::class)->orderBy('order');
    }
}
