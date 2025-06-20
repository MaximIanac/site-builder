<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogCategoryData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProductProperty;

class MCatalogCategoryApiController extends Controller
{
    public function getCategoryParentProperties(Request $request): JsonResource
    {
        $category = MCatalogCategory::findOrFail($request->category);

        return JsonResource::make([
            'properties' => MCatalogProductPropertyData::collect(
                MCatalogProductProperty::whereHas('categories', fn($q) =>
                    $q->whereIn('m_catalog_categories.id', $category->getAllParentCategories()->pluck('id'))
                )->get()
            ),
        ]);
    }

    public function getAllChildCategories(Request $request): JsonResource
    {
        $category = MCatalogCategory::findOrFail($request->category);

        return JsonResource::make([
            'categories' => MCatalogCategoryData::collect(
                $category->getAllChildCategories()
            ),
        ]);
    }
}
