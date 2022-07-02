<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Category Title is required',
            'title.string' => 'Category Title must be a string',

            'description.required' => 'Category Description is required',
            'description.string' => 'Category Description must be a string'
        ];
    }
}
