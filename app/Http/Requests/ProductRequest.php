<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string',
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|image',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'category' => 'required|exists:categories,id',
            'sub_category' =>'required|exists:sub_categories,id'
        ];
    }
}
