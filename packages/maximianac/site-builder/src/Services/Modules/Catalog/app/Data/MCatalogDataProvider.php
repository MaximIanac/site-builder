<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data;

use Illuminate\Http\Request;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProduct;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProductProperty;
use Spatie\LaravelData\PaginatedDataCollection;

class MCatalogDataProvider
{
    public static function handle(Request $request): MCatalogData
    {
        $productQuery = MCatalogProduct::with([
            'category',
            'propertyValues', 'propertyValues.property',
            'offers', 'offers.propertyValues', 'offers.propertyValues.property'
        ]);
        $propertyQuery = MCatalogProductProperty::query();

        if ($request->has('chosen_category')) {
            $categorySlug = $request->query('chosen_category');
            $productQuery = $productQuery->whereHas('category', fn($q) => $q->where('slug', $categorySlug));

            $category = MCatalogCategory::where('slug', $categorySlug)->first();

            if ($category) {
                $propertyQuery = $propertyQuery->whereHas('categories', fn($q) =>
                    $q->whereIn('m_catalog_categories.id', $category->getAllParentCategories()->pluck('id'))
                );
            }
        }

        return new MCatalogData(
            categories: MCatalogCategoryData::collect(
                MCatalogCategory::where('parent_id', null)->with('parent', 'allChildren')->get()
            ),
            products: MCatalogProductData::collect(
                $productQuery->paginate($request->query('pageSize', 10)),
                PaginatedDataCollection::class
            ),
            properties: MCatalogProductPropertyData::collect($propertyQuery->get()),
        );
    }
}
