<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mdlId = DB::table('currencies')->insertGetId([
            'code' => 'MDL',
            'symbol' => 'L',
            'rate' => 1.000000,
            'is_default' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categories = [
            'Electronics' => [
                'category_properties' => ['Brand', 'Model', 'Warranty'],
                'offer_properties' => ['RAM', 'Storage', 'Color'],
                'images' => ['electronics-1.jpg', 'electronics-2.jpg', 'electronics-3.jpg']
            ],
            'Furniture' => [
                'category_properties' => ['Material', 'Style', 'Dimensions'],
                'offer_properties' => ['Color', 'Assembly Required'],
                'images' => ['furniture-1.jpg', 'furniture-2.jpg', 'furniture-3.jpg']
            ],
            'Clothing' => [
                'category_properties' => ['Gender', 'Season', 'Style'],
                'offer_properties' => ['Size', 'Color', 'Fabric'],
                'images' => ['clothing-1.jpg', 'clothing-2.jpg', 'clothing-3.jpg']
            ],
        ];

        foreach ($categories as $catName => $props) {
            // Создаем категорию
            $categoryId = DB::table('m_catalog_categories')->insertGetId([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'description' => "Category for $catName",
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Свойства категории
            foreach ($props['category_properties'] as $attr) {
                $attrId = DB::table('m_catalog_product_properties')->insertGetId([
                    'name' => $attr,
                    'code' => Str::slug($attr),
                    'type' => 'string',
                    'usage_type' => 'category',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('m_catalog_category_product_property')->insert([
                    'category_id' => $categoryId,
                    'property_id' => $attrId,
                ]);
            }

            // Свойства торговых предложений
            $offerPropertyIds = [];
            foreach ($props['offer_properties'] as $attr) {
                $offerAttrId = DB::table('m_catalog_product_properties')->insertGetId([
                    'name' => $attr,
                    'code' => Str::slug($attr),
                    'type' => 'string',
                    'usage_type' => 'offer',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $offerPropertyIds[] = $offerAttrId;
            }

            // Создаем продукты
            foreach (range(1, 5) as $i) {
                $productId = DB::table('m_catalog_products')->insertGetId([
                    'category_id' => $categoryId,
                    'name' => "$catName Product $i",
                    'slug' => Str::slug("$catName Product $i"),
                    'short_description' => "Short description of $catName Product $i",
                    'description' => "Full description of $catName Product $i",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Создаем торговые предложения
                foreach (range(1, 2) as $j) {
                    $offerId = DB::table('m_catalog_product_offers')->insertGetId([
                        'product_id' => $productId,
                        'sku' => strtoupper(Str::random(8)),
                        'quantity' => rand(1, 20),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Цены в MDL
                    $price = rand(5000, 50000) / 100;
                    DB::table('m_catalog_product_offer_prices')->insert([
                        'offer_id' => $offerId,
                        'currency_id' => $mdlId,
                        'price' => $price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Свойства предложений
                    foreach ($offerPropertyIds as $attrId) {
                        DB::table('m_catalog_product_offer_property_values')->insert([
                            'offer_id' => $offerId,
                            'property_id' => $attrId,
                            'value' => $this->getFakeValueForProperty($attrId),
                        ]);
                    }
                }
            }
        }
    }

    private function getFakeValueForProperty($propertyId)
    {
        $property = DB::table('m_catalog_product_properties')->find($propertyId);

        if (str_contains($property->code, 'color')) {
            return fake()->colorName();
        } elseif (str_contains($property->code, 'size')) {
            return fake()->randomElement(['S', 'M', 'L', 'XL']);
        } elseif (str_contains($property->code, 'ram')) {
            return fake()->randomElement(['8GB', '16GB', '32GB']);
        } elseif (str_contains($property->code, 'storage')) {
            return fake()->randomElement(['256GB', '512GB', '1TB']);
        } elseif (str_contains($property->code, 'brand')) {
            return fake()->randomElement(['Apple', 'Samsung', 'Sony', 'LG']);
        }

        return fake()->word();
    }
}
