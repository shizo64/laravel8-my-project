<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'language_id' => 'nullable|integer',
        ];
    }
}