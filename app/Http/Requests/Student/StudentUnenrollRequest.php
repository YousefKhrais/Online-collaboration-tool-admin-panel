<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentUnenrollRequest extends FormRequest
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
     * Get the validation rules that apply to the request.*
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Student id is required',
            'student_id.integer' => 'Student id must be a number'
        ];
    }
}
