<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MCatalogCategoryUpdateRequest extends FormRequest
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
        $categoryId = $this->route('category');

        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s\-]+$/',
                Rule::unique('m_catalog_categories', 'name')->ignore($categoryId)
            ],
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:m_catalog_categories,id',
            'inherited_properties' => 'sometimes|array',
            'inherited_properties.*' => 'integer|exists:m_catalog_product_properties,id',
            'added_properties' => 'sometimes|array',
            'added_properties.*' => 'integer|exists:m_catalog_product_properties,id'
        ];
    }
}
