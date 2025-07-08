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
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('m_catalog_products', 'slug')->ignore($productSlug),
            ],
            'category_id' => 'required|exists:m_catalog_categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'offers' => 'required|json',
            'properties' => 'nullable|array',
            'media' => 'nullable|array',
            'media.*' => 'nullable|image|max:5096'
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
        $offers = json_decode($this->input('offers'), true);

        $validator = Validator::make(['offers' => $offers], [
            'offers.*.sku' => ['required', 'string'],
            'offers.*.price' => ['required', 'numeric', 'min:0'],
            'offers.*.stock' => ['required', 'integer', 'min:0'],
            'offers.*.properties' => ['nullable', 'array'],
            'offers.*.properties.*.id' => ['nullable', 'integer', 'exists:m_catalog_product_properties,id'],
            'offers.*.properties.*.value' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'offers' => ['Error in offers data.']
            ]);
        }
    }
}
