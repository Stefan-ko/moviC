<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tag_name_uk.*' => 'required|string|max:255',
            'tag_name_en.*' => 'required|string|max:255',
        ];
    }

}
