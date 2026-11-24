<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMangaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $manga = $this->route('manga');

        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('mangas', 'title')->ignore($manga),
            ],
            'genre' => 'sometimes|required|string|max:100',
            'synopsis' => 'sometimes|nullable|string',
            'total_chapter' => 'sometimes|required|integer|min:0',
            'release_year' => 'sometimes|nullable|integer|min:1900|max:2100',
        ];
    }
}
