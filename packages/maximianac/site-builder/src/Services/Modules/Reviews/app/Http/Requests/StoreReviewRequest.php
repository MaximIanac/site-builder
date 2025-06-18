<?php

namespace Maximianac\SiteBuilder\Services\Modules\Reviews\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'content' => 'required|string|max:1000',
        ];
    }
}
