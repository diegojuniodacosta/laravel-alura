<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'              => ['required', 'min:2'],
            'seasonsQty'        => ['nullable', 'integer', 'min:1'],
            'episodesPerSeason' => ['nullable', 'integer', 'min:1'],
            'cover'             => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
    }
}

