<?php

namespace Maximianac\SiteBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class CBlockEntry extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    protected $table = 'cblock_entries';
    protected $guarded = [];
    protected array $translatable = ['value'];
    protected $with = ['slides'];

    protected $casts = [
        'type' => CBlockEntryTypeEnum::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function cblock(): BelongsTo
    {
        return $this->belongsTo(CBlock::class);
    }

    public function slides(): HasMany
    {
        return $this->hasMany(CBlockSlide::class, 'cblock_entry_id')->orderBy('order');
    }

    public function scopeOfType($query, CBlockEntryTypeEnum $type)
    {
        return $query->where('type', $type);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('page')
            ->singleFile();
    }

    public function getImageAttribute(): ?Media
    {
        return $this->getFirstMedia('page');
    }
}
