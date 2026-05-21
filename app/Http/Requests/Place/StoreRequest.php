<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'category_id' => 'required|exists:categories,id',
            'word_ru'     => 'required|string|max:255',
            'word_target' => 'required|string|max:255',
            'transcription' => 'nullable|string|max:255',
            'image'       => 'nullable|string',
        ];
    }
}
