<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MCatalogProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productSlug = $this->route('product');

        return [
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('m_catalog_products', 'slug')->ignore($productSlug),
            ],
            'name' => 'sometimes|array',
            'name.*' => 'required|string',
            'short_description' => 'nullable|array',
            'short_description.*' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string|max:800',
            'category_id' => 'required|integer|exists:m_catalog_categories,id',

            'properties' => 'nullable|array',
            'properties.*.id' => 'nullable|integer|exists:m_catalog_properties,id',
            'properties.*.value' => 'nullable|array',
            'properties.*.value.*' => 'nullable|string',

            'variants' => 'array',
            'variants.*.sku' => [
                'required',
                'string',
                'distinct',
                Rule::unique('m_catalog_product_variants', 'sku')
                    ->where(fn ($q) => $q->whereNotIn(
                        'sku',
                        collect(request('variants'))->pluck('sku')->filter()
                    )),
            ],
            'variants.*.price' => 'required|numeric',
            'variants.*.quantity' => 'required|integer',

            'variants.*.properties' => 'array',
            'variants.*.properties.*.id' => 'required|integer|exists:m_catalog_properties,id',
            'variants.*.properties.*.value' => 'nullable|array',
            'variants.*.properties.*.value.*' => 'nullable|string',

            'media' => 'sometimes|array',
            'media.*' => 'sometimes|array',
            'media.*.file' => 'nullable|file|image|max:5096',
//            'media.*.file' => 'sometimes|nullable|file|image|max:5096',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validateResolved(): void
    {
        parent::validateResolved();

        $this->validateOffersJson();
    }

    /**
     * @throws ValidationException
     */
    protected function validateOffersJson(): void
    {
        $offers = json_decode($this->input('variant'), true);

        $validator = Validator::make(['variant' => $offers], [
            'variant.*.sku' => ['required', 'string'],
            'variant.*.price' => ['required', 'numeric', 'min:0'],
            'variant.*.stock' => ['required', 'integer', 'min:0'],
            'variant.*.properties' => ['nullable', 'array'],
            'variant.*.properties.*.id' => ['nullable', 'integer', 'exists:m_catalog_product_properties,id'],
            'variant.*.properties.*.value' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'variant' => ['Error in variant data.']
            ]);
        }
    }
}
