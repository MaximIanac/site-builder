<?php

namespace Maximianac\SiteBuilder\Http\Requests\Content\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;

class StorePageRequest extends FormRequest
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
            'slug' => 'required|string|max:255|unique:pages,slug',
            'title' => 'required|array',
            'title.*' => 'required|string',
            'is_active' => 'required|boolean',

            'cblocks' => 'nullable|array',
            'cblocks.*.key' => 'required|string|max:50',

            'cblocks.*.entries' => 'required|array',
            'cblocks.*.entries.*.key' => 'required|string|max:50',
            'cblocks.*.entries.*.type' => ['nullable', new Enum(CBlockEntryTypeEnum::class)],
            'cblocks.*.entries.*.value' => 'nullable|array',
            'cblocks.*.entries.*.value.*' => 'nullable|string',

            'cblocks.*.entries.*.slides' => 'nullable|array',
            'cblocks.*.entries.*.slides.*.entries.*.key' => 'required|string|max:50',
            'cblocks.*.entries.*.slides.*.entries.*.type' => ['nullable', new Enum(CBlockEntryTypeEnum::class)],
            'cblocks.*.entries.*.slides.*.entries.*.value' => 'required|array',
            'cblocks.*.entries.*.slides.*.entries.*.value.*' => 'nullable|string',
        ];
    }
}
