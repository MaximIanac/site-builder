<?php

namespace Maximianac\SiteBuilder\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $this->route('page')->id,
            'template' => 'required|string',
            'content' => 'nullable|array',
            'content.*.key' => 'required|string',
            'content.*.values' => 'nullable|array',
            'content.*.values.*.type' => 'nullable|string',
            'content.*.values.*.key' => 'nullable|string',
            'files' => 'nullable',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,svg|max:4096',
        ];
    }
}
