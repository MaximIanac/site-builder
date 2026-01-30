<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MCatalogProductStoreRequest extends FormRequest
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
        return [
            'slug' => 'required|string|max:255|unique:m_catalog_products,slug',
            'name' => 'required|array',
            'name.*' => 'required|string',
            'short_description' => 'nullable|array',
            'short_description.*' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string|max:800',
            'category_id' => 'nullable|integer|exists:m_catalog_categories,id',

            'properties' => 'nullable|array',
            'properties.*.id' => 'nullable|integer|exists:m_catalog_properties,id',
            'properties.*.value' => 'nullable|array',
            'properties.*.value.*' => 'nullable|string',

            'variants' => 'array',
            'variants.*.sku' => 'required|string',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' => 'required|integer',

            'variants.*.properties' => 'array',
            'variants.*.properties.*.id' => 'required|integer|exists:m_catalog_properties,id',
            'variants.*.properties.*.value' => 'nullable|array',
            'variants.*.properties.*.value.*' => 'nullable|string',

            'media' => 'nullable|array',
            'media.*' => 'nullable|image|max:5096'
        ];
    }
}
