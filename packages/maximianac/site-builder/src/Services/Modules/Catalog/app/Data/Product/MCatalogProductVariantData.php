<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product;

use Illuminate\Support\Collection;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogVariantPrice;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class MCatalogProductVariantData extends Data
{
    public function __construct(
        public int                           $id,
        public string                        $sku,

//        #[DataCollectionOf(MCatalogProductVariantPriceData::class)]
        #[MapInputName('prices')]
        public Collection|float              $price,
        public int                           $quantity,

        #[DataCollectionOf(MCatalogPropertyData::class)]
        public Collection                    $properties,
        public MCatalogProductData|Optional  $product,
    ) {
        $this->price = $this->price->first()->price;
    }

//    public static function fromDebug($data)
//    {
//        if (is_object($data)) {
//            dump($data->toArray());
//        }
//
//        try {
//            $result = self::from($data);
//            dump('✅ Data created successfully');
//            dump('Final price value:', $result->price);
//            return $result;
//        } catch (\Exception $e) {
//            dump('❌ Error:', $e->getMessage());
//            throw $e;
//        }
//    }
}
