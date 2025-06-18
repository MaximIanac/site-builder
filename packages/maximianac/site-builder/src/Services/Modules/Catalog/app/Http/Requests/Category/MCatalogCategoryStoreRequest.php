<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class MCatalogCategoryStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\-]+$/'],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:m_catalog_categories,id'],
            'inherited_properties' => ['array'],
            'inherited_properties.*' => ['integer', 'exists:m_catalog_product_properties,id'],
            'added_properties' => ['array'],
            'added_properties.*' => ['integer', 'exists:m_catalog_product_properties,id'],
        ];
    }
}
