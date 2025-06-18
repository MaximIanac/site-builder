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

class ContentEntry extends Model
{
    use SyncTranslations;

    protected $guarded = [];
    protected $table = 'content_entries';

    protected $casts = [
        'type' => EntryType::class,
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function getImagePath()
    {
        if ($this->type !== EntryType::File) {
            return null;
        }

        return $this->translations()->first()->value;
    }

    public function scopeOfLang($query, string $lang)
    {
        return $query->where('lang', $lang);
    }
}
