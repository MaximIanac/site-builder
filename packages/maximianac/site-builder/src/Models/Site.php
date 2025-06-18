<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maximianac\SiteBuilder\Utility\Enums\SiteType;

class Site extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'type' => SiteType::class,
        'supported_langs' => 'array'
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
