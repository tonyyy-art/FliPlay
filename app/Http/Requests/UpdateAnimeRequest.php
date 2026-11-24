<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $anime = $this->route('anime');

        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('animes', 'title')->ignore($anime),
            ],
            'genre' => 'sometimes|required|string|max:100',
            'synopsis' => 'sometimes|nullable|string',
            'total_episode' => 'sometimes|required|integer|min:0',
            'release_year' => 'sometimes|nullable|integer|min:1900|max:2100',
        ];
    }
}
