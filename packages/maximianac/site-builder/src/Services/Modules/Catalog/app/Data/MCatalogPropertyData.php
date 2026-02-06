<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class MCatalogPropertyData extends Data
{
    public function __construct(
        public int                                $id,
        public string                             $name,
        public string                             $code,
        public string                             $type,

        #[MapInputName('pivot')]
        public MCatalogPropertyValueData|Optional|null $pivot,
    ) {}
}
