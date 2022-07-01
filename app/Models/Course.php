<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string title
 * @property mixed|string description
 * @property mixed|string image_link
 * @property mixed|double price
 * @property mixed|integer num_of_hours
 * @property mixed|integer teacher_id
 * @property mixed|integer category_id
 * @property mixed|integer students_count
 */
class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_link',
        'price',
        'num_of_hours',
        'teacher_id',
        'category_id',
        'students_count'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getStudentsCount()
    {
        return count($this->students()->get());
    }
}
