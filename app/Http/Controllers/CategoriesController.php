<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Course;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('dashboard.categories.index')->with('categories', Category::select('*')->get());
    }

    public function view($id)
    {
        $category = Category::with('courses')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($category != null) {
            return view('dashboard.categories.view', array('category' => $category));
        } else {
            return redirect()->route('dashboard.categories.index')->withErrors(['Category does not exists.']);
        }
    }

    public function store(CategoryCreateRequest $request)
    {
        $title = $request['title'];
        $description = $request['description'];

        if (!Category::where([['title', '=', $title]])->exists()) {
            $category = new Category();
            $category->title = $title;
            $category->description = $description;
            $category->courses_count = 0;

            $result = $category->save();
            return redirect()->back()->with('add_status', $result);
        } else {
            return redirect()->back()->withErrors(['Another Category with the same title already exists.']);
        }
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $title = $request['title'];
        $description = $request['description'];
//        $image_link = $request['image_link'];

        if (!Category::where([['id', '=', $id]])->exists())
            return redirect()->back()->withErrors(['Category does not exists.']);

        $result = Category::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
//            'image_link' => ""
        ]);

        return redirect()->back()->with('update_status', $result);
    }

    public function destroy($id)
    {
        $category = Category::with('courses')
            ->select('*')
            ->where('id', $id)
            ->first();

        if ($category == null)
            return redirect()->back()->withErrors(['Category does not exists.']);

        if (count($category->courses) != 0)
            return redirect()->back()->withErrors(["The Category can't be deleted because it's not empty (Delete the category courses first)."]);

        $result = $category->delete();
        return redirect()->back()->with('add_status', $result);
    }
}
