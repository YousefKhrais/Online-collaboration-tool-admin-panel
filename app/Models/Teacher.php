<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone_number',
        'date_of_birth',
        'status',
        'gender',
        'address',
        'image_link',
        'stack_overflow',
        'linkedin',
        'github',
        'courses_count',
        'requests_count',
        'description',
        'interests',
        'remember_token'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function getGender()
    {
        if ($this->gender) {
            return "Female";
        } else {
            return "Male";
        }
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCoursesCount()
    {
        return count($this->courses()->get());
    }
}
