<?php

namespace Maximianac\SiteBuilder\Data\Media;

use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProduct;
use Spatie\LaravelData\Data;

class MediaData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?array $images,
    ) {
        $this->images = $this->getMedia('products')->map(fn ($media) => [
            'url' => $media->getUrl(),
            'alt' => $media->getCustomProperty('alt'),
        ]);
    }
}
