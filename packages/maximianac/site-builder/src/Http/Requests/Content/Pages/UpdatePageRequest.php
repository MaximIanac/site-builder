<?php

namespace Maximianac\SiteBuilder\Http\Requests\Content\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Maximianac\SiteBuilder\Services\Content\Enums\CBlockEntryTypeEnum;

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
            'id' => 'required|integer|exists:pages,id',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $this->route('page')->id,
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'is_active' => 'required|boolean',

            'cblocks' => 'nullable|array',
            'cblocks.*.id' => 'nullable|integer|exists:cblocks,id',
            'cblocks.*.key' => 'required|string|max:50',

            'cblocks.*.entries' => 'required|array',
            'cblocks.*.entries.*.id' => 'nullable|integer|exists:cblock_entries,id',
            'cblocks.*.entries.*.key' => 'required|string|max:50',
            'cblocks.*.entries.*.type' => ['nullable', new Enum(CBlockEntryTypeEnum::class)],
            'cblocks.*.entries.*.value' => 'nullable|array',
            'cblocks.*.entries.*.value.*' => 'nullable',
            'cblocks.*.entries.*.value.file' => 'nullable|image|max:10240',

            'cblocks.*.entries.*.slides' => 'nullable|array',
            'cblocks.*.entries.*.slides.*' => 'nullable|array',
            'cblocks.*.entries.*.slides.*.id' => 'nullable|integer|exists:cblock_slides,id',
            'cblocks.*.entries.*.slides.*.entries' => 'nullable|array|min:1',
            'cblocks.*.entries.*.slides.*.entries.*.id' => 'nullable|integer|exists:cblock_slide_entries',
            'cblocks.*.entries.*.slides.*.entries.*.key' => 'required|string|max:50',
            'cblocks.*.entries.*.slides.*.entries.*.type' => ['nullable', new Enum(CBlockEntryTypeEnum::class)],
            'cblocks.*.entries.*.slides.*.entries.*.value' => 'nullable|array',
            'cblocks.*.entries.*.slides.*.entries.*.value.*' => 'nullable|string',
        ];
    }
}
