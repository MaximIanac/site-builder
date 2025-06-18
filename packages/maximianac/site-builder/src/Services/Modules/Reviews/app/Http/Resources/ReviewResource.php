<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'title' => $this->title,
            'content' => $this->content,
            'is_visible' => $this->is_visible,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
