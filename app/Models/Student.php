<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed date_of_birth
 * @property mixed phone_number
 * @property mixed email
 * @property mixed password
 * @property mixed gender
 * @property mixed|string photo_link
 * @property bool|mixed status
 * @property mixed|string profile_image
 */
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'email',
        'password',
        'gender',
        'photo_link',
        'status',
        'profile_image'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
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
