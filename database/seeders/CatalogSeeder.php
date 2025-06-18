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
        $categories = [
            'Electronics' => ['Brand', 'Model', 'Warranty'],
            'Furniture'   => ['Material', 'Color', 'Dimensions'],
            'Clothing'    => ['Size', 'Color', 'Fabric'],
        ];

        foreach ($categories as $catName => $attrs) {
            $categoryId = DB::table('m_catalog_categories')->insertGetId([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'description' => "Category for $catName",
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $propertyIds = [];

            foreach ($attrs as $attr) {
                $attrId = DB::table('m_catalog_product_properties')->insertGetId([
                    'name' => $attr,
                    'code' => Str::slug($attr),
                    'type' => 'string',
                    'is_required' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('m_catalog_category_product_property')->insert([
                    'category_id' => $categoryId,
                    'property_id' => $attrId,
                ]);
                $propertyIds[] = $attrId;
            }

            foreach (range(1, 5) as $i) {
                $productId = DB::table('m_catalog_products')->insertGetId([
                    'category_id' => $categoryId,
                    'name' => "$catName Product $i",
                    'slug' => Str::slug("$catName Product $i"),
                    'short_description' => "Short description of $catName Product $i",
                    'description' => "Full description of $catName Product $i",
                    'main_image' => null,
                    'images' => json_encode([]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($propertyIds as $attrId) {
                    DB::table('m_catalog_product_property_values')->insert([
                        'product_id' => $productId,
                        'property_id' => $attrId,
                        'value' => fake()->word(),
                    ]);
                }

                foreach (range(1, 2) as $j) {
                    $offerId = DB::table('m_catalog_product_offers')->insertGetId([
                        'product_id' => $productId,
                        'sku' => strtoupper(Str::random(8)),
                        'price' => rand(5000, 50000) / 100,
                        'quantity' => rand(1, 20),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    foreach ($propertyIds as $attrId) {
                        DB::table('m_catalog_product_offer_property_values')->insert([
                            'offer_id' => $offerId,
                            'property_id' => $attrId,
                            'value' => fake()->word(),
                        ]);
                    }
                }
            }
        }
    }
}
