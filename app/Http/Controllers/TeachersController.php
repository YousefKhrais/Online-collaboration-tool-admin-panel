<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\TeacherCreateRequest;
use App\Http\Requests\Teacher\TeacherUpdateRequest;
use App\Models\Category;
use App\Models\Teacher;

class TeachersController extends Controller
{
    public function index()
    {
        return view('dashboard.teachers.index')->with('teachers', Teacher::select('*')->get());
    }

    public function view($id)
    {
        $teacher = Teacher::with('courses')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($teacher == null)
            return redirect()->route('dashboard.teacher.index')->withErrors(['Teacher does not exists.']);

        return view('dashboard.teachers.view', array('teacher' => $teacher));
    }

    public function store(TeacherCreateRequest $request)
    {
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $phone_number = $request['phone_number'];
        $email = $request['email'];
        $password = $request['password'];
        $address = $request['address'];
        $gender = $request['gender'];
        $date_of_birth = $request['date_of_birth'];

        if (Teacher::where([['email', '=', $email]])->exists())
            return redirect()->back()->withErrors(['Another Teacher with same email already exists.']);

        $teacher = Teacher::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'gender' => $gender,
            'date_of_birth' => $date_of_birth,
            'photo_link' => "",
            'courses_count' => 0,
            'requests_count' => 0,
            'status' => 1
        ]);

        $result = $teacher->save();
        return redirect()->back()->with('add_status', $result);
    }

    public function update(TeacherUpdateRequest $request, $id)
    {
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $phone_number = $request['phone_number'];
        $email = $request['email'];
        $address = $request['address'];
        $gender = $request['gender'];
        $date_of_birth = $request['date_of_birth'];
        $photo_link = $request['photo_link'];
        $status = $request['status'];
//        $password = $request['password'];

        $teacher = Teacher::where('id', $id)->first();

        if ($teacher == null)
            return redirect()->back()->withErrors(['Teacher does not exist']);

        if (Teacher::where([['id', '!=', $id], ['email', '=', $email]])->exists())
            return redirect()->back()->withErrors(['Another Teacher with the same email already exists']);

        $result = Teacher::where('id', $id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'email' => $email,
            'address' => $address,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'status' => $status,
            'photo_link' => $photo_link
        ]);

        return redirect()->back()->with('update_status', $result);
    }

    public function destroy($id)
    {
        $teacher = Teacher::with('courses')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($teacher == null)
            return redirect()->back()->withErrors(['Teacher does not exists.']);

        if (count($teacher->courses) != 0)
            return redirect()->back()->withErrors(["The Teacher can't be deleted (You have to delete the teacher courses first)."]);

        $result = $teacher->delete();
        return redirect()->back()->with('add_status', $result);
    }
}
