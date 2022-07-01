<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|integer id
 * @property mixed|string email
 * @property mixed|string password
 * @property mixed|string first_name
 * @property mixed|string last_name
 * @property mixed|integer phone_number
 * @property mixed|string date_of_birth
 * @property mixed|boolean status
 * @property mixed|boolean gender
 * @property mixed|string address
 * @property mixed|string facebook
 * @property mixed|string twitter
 * @property mixed|string instagram
 * @property mixed|string linkedin
 * @property mixed|integer courses_count
 * @property mixed|string photo_link
 * @property mixed|integer requests_count
 */
class Teacher extends Model
{
    use HasFactory;

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
        'courses_count',
        'photo_link',
        'requests_count'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
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
