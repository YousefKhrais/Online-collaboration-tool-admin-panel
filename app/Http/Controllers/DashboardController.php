<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Request;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', array(
            'courses_count' => count(Course::select('*')->get()),
            'teachers_count' => count(Teacher::select('*')->get()),
            'students_count' => count(Student::select('*')->get()),
            'categories_count' => count(Category::select('*')->get()),
            'requests_count' => count(Request::select('*')->get())
        ));
    }

    public function profile()
    {
        return view('dashboard.profile', array('user' => Auth::user()));
    }
}
