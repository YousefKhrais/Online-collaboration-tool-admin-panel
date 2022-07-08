<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class AcceptRequest extends FormRequest
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
            'admin_note' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'admin_note.string' => 'Admin Note must be a string'
        ];
    }
}
