<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data;

use Illuminate\Http\Request;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProduct;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProperty;
use Spatie\LaravelData\PaginatedDataCollection;

class MCatalogDataProvider
{
    public static function handle(Request $request): MCatalogData
    {
        $productQuery = MCatalogProduct::with(['category', 'variants']);

        if ($request->has('chosen_category')) {
            $category = MCatalogCategory::where('slug', $request->query('chosen_category'))->first();

            if ($category) {
                $productQuery = $productQuery->inCategoryWithChildren($category);
            }
        }

//        dd(MCatalogProductData::collect($productQuery->get()));

        return new MCatalogData(
            categories: MCatalogCategoryData::collect(
                MCatalogCategory::where('parent_id', null)->with('parent', 'allChildren')->get()
            ),
            products: MCatalogProductData::collect(
                $productQuery->paginate($request->query('pageSize', 10)),
                PaginatedDataCollection::class
            )
//            properties: MCatalogPropertyData::collect($propertyQuery->get()),
        );
    }
}
