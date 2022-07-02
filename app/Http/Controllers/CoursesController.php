<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Course\CourseUpdateRequest;
use App\Http\Requests\Student\StudentEnrollRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    public function index()
    {
        return view('dashboard.courses.index', array(
            'courses' => Course::select('*')->get(),
            'teachers' => Teacher::select('*')->get(),
            'categories' => Category::select('*')->get(),
        ));
    }

    public function view($id)
    {
        $course = Course::with('students')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($course == null)
            return redirect()->back()->withErrors(['Course does not exists.']);

        return view('dashboard.courses.view', array(
            'course' => $course,
            'teachers' => Teacher::select('*')->get(),
            'categories' => Category::select('*')->get(),
            'students' => Student::select('*')->get()
        ));
    }

    public function store(CourseCreateRequest $request)
    {
        $title = $request['title'];
        $description = $request['description'];
        $credit = $request['credit'];
        $price = $request['price'];
        $teacherId = $request['teacher_id'];
        $categoryId = $request['category_id'];

        if (Course::where([['title', '=', $title]])->exists())
            return redirect()->back()->withErrors(['Another Course with the same title already exists.']);

        if (!Teacher::where([['id', '=', $teacherId]])->exists())
            return redirect()->back()->withErrors(['Selected teacher does not exists.']);

        if (!Category::where([['id', '=', $categoryId]])->exists())
            return redirect()->back()->withErrors(['Selected category does not exists.']);

        $course = Course::create([
            'title' => $title,
            'description' => $description,
            'num_of_hours' => $credit,
            'price' => $price,
            'teacher_id' => $teacherId,
            'category_id' => $categoryId,
            'image_link' => "",
            'students_count' => 0
        ]);

        $result = $course->save();

        if ($result) {
            Teacher::where('id', $teacherId)->update(['courses_count' => DB::raw('courses_count+1')]);
            Category::where('id', $categoryId)->update(['courses_count' => DB::raw('courses_count+1')]);
        }

        return redirect()->back()->with('add_status', $result);
    }

    public function update(CourseUpdateRequest $request, $id)
    {
        $title = $request['title'];
        $description = $request['description'];
        $credit = $request['credit'];
        $price = $request['price'];
        $teacherId = $request['teacher_id'];
        $categoryId = $request['category_id'];

        if (!Course::where([['id', '=', $id]])->exists())
            return redirect()->back()->withErrors(['Course does not exists.']);

        if (!Teacher::where([['id', '=', $teacherId]])->exists())
            return redirect()->back()->withErrors(['Selected teacher does not exists.']);

        if (!Category::where([['id', '=', $categoryId]])->exists())
            return redirect()->back()->withErrors(['Selected category does not exists.']);

        $result = Course::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
            'num_of_hours' => $credit,
            'price' => $price,
            'teacher_id' => $teacherId,
            'category_id' => $categoryId,
            'image_link' => ""
        ]);

        return redirect()->back()->with('update_status', $result);
    }

    public function destroy($id)
    {
        $course = Course::where('id', $id)->first();

        if ($course == null)
            return redirect()->back()->withErrors(['Course does not exists.']);

        $result = $course->delete();
        return redirect()->back()->with('add_status', $result);
    }

    public function enroll(StudentEnrollRequest $request, $id)
    {
        $studentId = $request['student_id'];

        if (!Course::where([['id', '=', $id]])->exists())
            return redirect()->back()->withErrors(['Course does not exists.']);

        if (!Student::where([['id', '=', $studentId]])->exists())
            return redirect()->back()->withErrors(['Selected student does not exists.']);

        $course = Course::where('id', $id)->first();
        $result = $course->students()->attach($studentId);

        return redirect()->back()->with('update_status', $result);
    }
}
