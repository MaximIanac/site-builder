<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProductProperty;

class MCatalogPropertyApiController extends Controller
{
    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'code' => ['required', 'string', 'max:20', 'alpha_dash', 'unique:m_catalog_product_properties,code'],
            'type' => ['required', Rule::in(['string', 'text', 'integer', 'float', 'boolean'])],
            'is_required' => ['boolean'],
        ]);

        return JsonResource::make(
            MCatalogProductPropertyData::from(
                MCatalogProductProperty::create($validated)
            )
        );
    }
}
