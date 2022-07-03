<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required',
            'first_name.string' => 'First Name must be a string',

            'last_name.required' => 'Last Name is required',
            'last_name.string' => 'Last Name must be a string',

            'phone_number.required' => 'Phone Number is required',
            'phone_number.numeric' => 'Phone Number must be a number 0-9',

            'date_of_birth.date' => 'Date Of Birth must be a date',

            'email.required' => 'Email is required',
            'email.email' => 'Email must be a string',

            'password.required' => 'Password Link is required',
            'password.string' => 'Password Link must be a string',

            'gender.required' => 'Gender is required',
            'gender.boolean' => 'Gender must be a boolean'
        ];
    }
}
