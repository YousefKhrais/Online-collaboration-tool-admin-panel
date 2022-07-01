<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseCreateRequest extends FormRequest
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
     * $table->string('image_link')->nullable(false);
     *
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'credit' => 'required|integer',
            'teacher_id' => 'required|integer',
            'category_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Course Title is required',
            'title.string' => 'Course Title must be a string',

            'description.required' => 'Course Description is required',
            'description.string' => 'Course Description must be a string',

            'price.required' => 'Course Price is required',
            'price.regex' => 'Course Price must be a number',

            'credit.required' => 'Number Of Hours (Course Credits) is required',
            'credit.integer' => 'Number Of Hours (Course Credits) must be a number',

            'teacher_id.required' => 'Teacher is required',
            'teacher_id.integer' => 'Teacher must be a number',

            'category_id.required' => 'Category is required',
            'category_id.integer' => 'Category must be a number'
        ];
    }
}
