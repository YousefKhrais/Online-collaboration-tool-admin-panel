<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\TeacherCreateRequest;
use App\Http\Requests\Teacher\TeacherUpdateRequest;
use App\Models\Category;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
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
            ->with('requests')
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
            'password' => Hash::make($password),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'address' => $address,
            'image_link' => "https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp",
            'description' => "Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut",
            'courses_count' => 0,
            'requests_count' => 0,
            'status' => 1
        ]);

        $result = $teacher->save();

        if ($result)
            Session::flash('alert-success', 'Successfully created teacher');
        else
            Session::flash('alert-danger', 'Failed to create teacher');

        return redirect()->back();
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

        if ($result)
            Session::flash('alert-success', 'Successfully updated teacher');
        else
            Session::flash('alert-danger', 'Failed to update teacher');

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

        if ($result)
            Session::flash('alert-success', 'Successfully deleted teacher');
        else
            Session::flash('alert-danger', 'Failed to deleted teacher');

        return redirect()->back();
    }
}
