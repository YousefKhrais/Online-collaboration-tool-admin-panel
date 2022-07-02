<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\TeacherCreateRequest;
use App\Http\Requests\Teacher\TeacherUpdateRequest;
use App\Models\Category;
use App\Models\Teacher;
use Illuminate\Support\Facades\Session;

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
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'address' => $address,
            'image_link' => "",
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
        $image_link = $request['image_link'];
        $status = $request['status'];

        $teacher = Teacher::where('id', $id)->first();

        if ($teacher == null)
            return redirect()->back()->withErrors(['Teacher does not exist']);

        if (Teacher::where([['id', '!=', $id], ['email', '=', $email]])->exists())
            return redirect()->back()->withErrors(['Another Teacher with the same email already exists']);

        $result = Teacher::where('id', $id)->update([
            'email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'address' => $address,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'status' => $status,
            'image_link' => $image_link
        ]);

        Session::flash('alert-success', 'success');
        return redirect()->back();
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
