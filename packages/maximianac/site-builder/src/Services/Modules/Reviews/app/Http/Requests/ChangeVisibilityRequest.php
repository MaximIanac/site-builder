<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeVisibilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_visible' => 'required|boolean',
        ];
    }
}
