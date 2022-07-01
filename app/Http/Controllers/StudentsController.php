<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Student\StudentCreateRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;

class StudentsController extends Controller
{
    public function index()
    {
        return view('dashboard.students.index', array(
            'students' => Student::select('*')->get()
        ));
    }

    public function view($id)
    {
        $student = Student::with('courses')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($student != null) {
            return view('dashboard.students.view', array(
                'student' => $student
            ));
        } else {
            return redirect()->route('dashboard.student.index')->withErrors(['Student does not exists.']);
        }
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

        if (!Student::where([['email', '=', $email]])->exists()) {
            $student = new Student();
            $student->first_name = $first_name;
            $student->last_name = $last_name;
            $student->date_of_birth = $date_of_birth;
            $student->phone_number = $phone_number;
            $student->email = $email;
            $student->password = $password;
            $student->gender = $gender;
            $student->profile_image = "";
            $student->status = true;

            $result = $student->save();
            return redirect()->back()->with('add_status', $result);
        } else {
            return redirect()->back()->withErrors(['Another student with the same email already exists.']);
        }
    }

    public function update(CourseCreateRequest $request, $id)
    {
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $phone_number = $request['phone_number'];
        $email = $request['email'];
        $address = $request['address'];
        $date_of_birth = $request['date_of_birth'];
        $gender = $request['gender'];
        $status = $request['status'];

        $teacher = Teacher::where('id', $id)->first();

        if ($teacher != null) {
            if (!Teacher::where([['id', '!=', $id], ['email', '=', $email]])->exists()) {
                $result = Teacher::where('id', $id)->update([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone_number' => $phone_number,
                    'email' => $email,
                    'address' => $address,
                    'date_of_birth' => $date_of_birth,
                    'gender' => $gender,
                    'status' => $status
                ]);
                return redirect()->back()->with('add_status', $result);
            } else {
                return redirect()->back()->withErrors(['Another Teacher with the same email already exists']);
            }
        } else {
            return redirect()->back()->withErrors(['Teacher does not exist']);
        }
    }

    public function destroy($id)
    {
        $course = Course::where('id', $id)->first();
        if ($course != null) {
            $result = $course->delete();

            return redirect()->back()->with('add_status', $result);
        } else {
            return redirect()->route('dashboard.course.index')->withErrors(['Course does not exists.']);
        }
    }
}
