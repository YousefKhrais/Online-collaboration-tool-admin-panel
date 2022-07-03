<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Student\StudentCreateRequest;
use App\Http\Requests\Teacher\StudentUpdateRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Session;

class StudentsController extends Controller
{
    public function index()
    {
        return view('dashboard.students.index', array('students' => Student::select('*')->get()));
    }

    public function view($id)
    {
        $student = Student::with('courses')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($student == null)
            return redirect()->route('dashboard.student.index')->withErrors(['Student does not exists.']);

        return view('dashboard.students.view', array('student' => $student));
    }

    public function store(StudentCreateRequest $request)
    {
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $date_of_birth = $request['date_of_birth'];
        $phone_number = $request['phone_number'];
        $email = $request['email'];
        $password = $request['password'];
        $gender = $request['gender'];

        if (Student::where([['email', '=', $email]])->exists())
            return redirect()->back()->withErrors(['Another student with the same email already exists.']);

        $student = Student::create([
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'image_link' => "img/user.png",
            'status' => 1
        ]);

        $result = $student->save();

        if ($result)
            Session::flash('alert-success', 'Successfully created student');
        else
            Session::flash('alert-danger', 'Failed to create student');

        return redirect()->back();
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $phone_number = $request['phone_number'];
        $email = $request['email'];
        $date_of_birth = $request['date_of_birth'];
        $gender = $request['gender'];
        $status = $request['status'];

        $student = Student::where('id', $id)->first();

        if ($student == null)
            return redirect()->back()->withErrors(['Student does not exist']);

        if (Student::where([['id', '!=', $id], ['email', '=', $email]])->exists())
            return redirect()->back()->withErrors(['Another Student with the same email already exists']);

        $result = Student::where('id', $id)->update([
            'email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'status' => $status
        ]);

        if ($result)
            Session::flash('alert-success', 'Successfully updated student');
        else
            Session::flash('alert-danger', 'Failed to update student');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $student = Student::where('id', $id)->first();

        if ($student == null)
            return redirect()->route('dashboard.course.index')->withErrors(['Student does not exists.']);

        $result = $student->delete();

        if ($result)
            Session::flash('alert-success', 'Successfully deleted student');
        else
            Session::flash('alert-danger', 'Failed to deleted student');

        return redirect()->back();
    }
}
