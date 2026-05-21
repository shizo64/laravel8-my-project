<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id'  => 'nullable|exists:categories,id',
            'word_ru'      => 'nullable|string|max:255',
            'word_target'  => 'nullable|string|max:255',
            'transcription'=> 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}