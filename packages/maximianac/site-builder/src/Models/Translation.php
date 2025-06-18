<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;

class Translation extends Model
{
    protected $guarded = [];

    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }
}
