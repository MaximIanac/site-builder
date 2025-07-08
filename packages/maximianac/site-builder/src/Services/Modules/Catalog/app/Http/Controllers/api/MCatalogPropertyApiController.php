<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\Product\MCatalogProductPropertyData;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyUsageTypeEnum;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogCategory;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Models\MCatalogProductProperty;

class MCatalogPropertyApiController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            'name' => ['required', 'array'],
            'code' => ['sometimes', 'nullable', 'string', 'max:20', 'alpha_dash'],
            'type' => ['required', Rule::in(['string', 'text', 'integer', 'float', 'boolean'])],
            'usage_type' => ['required', new Enum(PropertyUsageTypeEnum::class)],
        ]);

        $code = $validated['code'] ?? Str::slug(
            $validated['name']['en'] ?? collect($validated['name'])->first()
        );

        if (empty($validated['code']) && MCatalogProductProperty::where('code', $code)->exists()) {
            throw ValidationException::withMessages([
                'code' => [
                    'message' =>'The code generated already exists. Please use a different code.',
                    'value' => $code
                ],
            ]);
        }

        return JsonResource::make(MCatalogProductPropertyData::from(
            MCatalogProductProperty::create([
                'name' => json_encode($validated['name'], JSON_UNESCAPED_UNICODE),
                'code' => $code,
                'type' => $validated['type'],
                'usage_type' => $validated['usage_type'],
            ])
        ));
    }
}
