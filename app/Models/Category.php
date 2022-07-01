<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string title
 * @property mixed|integer students_count
 * @property mixed|string description
 * @property integer|mixed courses_count
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'courses_count'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getCoursesCount()
    {
        return count($this->courses()->get());
    }
}
