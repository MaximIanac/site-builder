<?php

namespace Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Maximianac\SiteBuilder\Services\Modules\Catalog\app\Enums\PropertyUsageTypeEnum;

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
            'parent_id' => ['nullable', 'exists:m_catalog_categories,id'],

            'locales' => ['required', 'array'],
            'locales.name' => ['required', 'array'],
            'locales.name.*' => ['required', 'string', 'unique:m_catalog_categories,name'],
            'locales.description' => ['nullable', 'array'],
            'locales.description.*' => ['nullable', 'string'],

            'inherited_properties' => ['array', 'nullable', 'sometimes'],
            'inherited_properties.*' => ['integer', 'exists:m_catalog_product_properties,id'],
            'added_properties' => ['array', 'nullable', 'sometimes'],
            'added_properties.*' => ['integer', 'exists:m_catalog_product_properties,id'],
        ];
    }
}
