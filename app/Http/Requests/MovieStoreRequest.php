<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|boolean',
            'title_uk' => 'required|string',
            'title_en' => 'required|string',
            'description_uk' => 'required|string',
            'description_en' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'screenshots.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'youtube_trailer_id' => 'nullable|string',
            'release_year' => 'required|integer|min:1900',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }

}
