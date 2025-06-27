<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\CurrencyEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class MCatalogProductOfferPriceData extends Data
{
    public function __construct(
        public float                     $value,
        public CurrencyEnum              $currency,
    ) {}

    public static function fromModel($model): self
    {
        return new self(
            value: $model->price,
            currency: $model->currency->code
        );
    }
}
