<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:animes,title',
            'genre' => 'required|string|max:100',
            'synopsis' => 'nullable|string',
            'total_episode' => 'required|integer|min:0',
            'release_year' => 'nullable|integer|min:1900|max:2100',
        ];
    }
}

