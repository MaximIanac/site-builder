<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
