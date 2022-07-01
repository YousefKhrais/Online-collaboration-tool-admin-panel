<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
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
            'address' => 'required|string',
            'phone_number' => 'required|integer',
            'email' => 'required|email',
            'date_of_birth' => 'required|date',
            'photo_link' => 'required|url',
            'gender' => 'required|boolean',
            'status' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required',
            'first_name.string' => 'First Name must be a string',

            'last_name.required' => 'Last Name is required',
            'last_name.string' => 'Last Name must be a string',

            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',

            'phone_number.required' => 'Phone Number is required',
            'phone_number.string' => 'Phone Number must be a number/integer',

            'email.required' => 'Email is required',
            'email.email' => 'Email must be a string',

            'date_of_birth.required' => 'Date Of Birth is required',
            'date_of_birth.date' => 'Date Of Birth must be a date',

            'photo_link.required' => 'Photo Link is required',
            'photo_link.url' => 'Photo Link must be a url',

            'gender.required' => 'Gender is required',
            'gender.boolean' => 'Gender must be a boolean',

            'status.required' => 'Status is required',
            'status.boolean' => 'Status must be a boolean'
        ];
    }
}
