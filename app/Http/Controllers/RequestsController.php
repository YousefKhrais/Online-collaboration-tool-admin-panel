<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request\AcceptRequest;
use App\Models\Course;
use App\Models\Request;
use Illuminate\Support\Facades\Session;

class RequestsController extends Controller
{
    public function index()
    {
        return view('dashboard.requests.index', array('requests' => Request::select('*')->get()));
    }

    public function view($id)
    {
        $request = Request::with('teacher')
            ->with('category')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($request == null)
            return redirect()->back()->withErrors(['Request does not exists.']);

        return view('dashboard.requests.view', array('request' => $request));
    }

    public function accept(AcceptRequest $accept_request, $id)
    {
        $admin_note = $accept_request['admin_note'];

        $request = Request::with('teacher')
            ->with('category')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($request == null)
            return redirect()->back()->withErrors(['Request does not exists.']);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'num_of_hours' => $request->num_of_hours,
            'price' => $request->price,
            'teacher_id' => $request->teacher_id,
            'category_id' => $request->category_id,
            'image_link' => "https://dashboard.programming-mentor.site/Home/assets/img/course-2.jpg",
            'students_count' => 0
        ]);

        $result = $course->save();

        if ($result) {
            $result = Request::where('id', $id)->update([
                'status' => 2,
                'admin_note' => $admin_note
            ]);
            if ($result)
                Session::flash('alert-success', 'Successfully accepted request & created a new course');
            else
                Session::flash('alert-danger', 'Failed to accept request');
        } else {
            Session::flash('alert-danger', 'Failed to accept request & create new course');
        }

        return redirect()->back();
    }

    public function reject(AcceptRequest $accept_request, $id)
    {
        $admin_note = $accept_request['admin_note'];

        if (!Request::where([['id', '=', $id]])->exists())
            return redirect()->back()->withErrors(['Request does not exists.']);

        $result = Request::where('id', $id)->update([
            'status' => 1,
            'admin_note' => $admin_note
        ]);

        if ($result)
            Session::flash('alert-success', 'Successfully rejected request');
        else
            Session::flash('alert-danger', 'Failed to reject request');

        return redirect()->back();
    }
}
