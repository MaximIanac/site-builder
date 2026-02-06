<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data;

use Illuminate\Support\Optional;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyOriginEnum;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class MCatalogPropertyValueData extends Data
{
    public function __construct(
        public string|Optional|null             $value,
        public array|Optional|null              $translations,
        public PropertyOriginEnum|Optional|null $origin,
    ) {
        if ($this->translations) {
            $this->translations = $this->translations['value'];
        }
    }
}
