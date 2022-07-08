<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Courses') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('courses') }}">Courses</a></li>
        <li class="breadcrumb-item active">View Course</li>
    </x-slot>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            @endif
        @endforeach
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="content">
        <div class="card w-100 p-3">
            <div class="card-header p-2">
                <div class="tabs-menu1">
                    <ul class="nav nav-pills">
                        <li class="nav-item ml-4">
                            <a class="nav-link active" data-toggle="tab" href="#tab0">Course Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab1">Students</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab0">
                        <form method="post" action="{{ URL('course/update/'.$course->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="column p-2 w-100">
                                        <div class="row">
                                            <div class="col">
                                                <div class="container">
                                                    <nav class="navbar navbar-expand-lg navbar-dark"
                                                         style="background: #309FDB">
                                                        <span class="navbar-brand">General Information</span>
                                                    </nav>
                                                    <div class="form-group">
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Course uid</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="number"
                                                                       placeholder="Course uid" disabled
                                                                       value="{{$course->id}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Course Title</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Course Title"
                                                                       name="title"
                                                                       value="{{$course->title}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Course
                                                                    Credits</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="number"
                                                                       placeholder="Course Credits"
                                                                       name="credit"
                                                                       value="{{$course->num_of_hours}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Course
                                                                    Price</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="number"
                                                                       placeholder="Course Price"
                                                                       name="price"
                                                                       value="{{$course->price}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Course Image</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Course Image"
                                                                       name="image_link"
                                                                       value="{{$course->image_link}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Course
                                                                    Description</label>
                                                            </div>
                                                            <div class="col">
                                                            <textarea class="form-control"
                                                                      placeholder="Course Description"
                                                                      name="description"
                                                                      rows="5">{{$course->description}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Students
                                                                    Count</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="number"
                                                                       placeholder="Students Count" disabled
                                                                       value="{{$course->getStudentsCount()}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Created
                                                                    At</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Created At" disabled
                                                                       name="created_at"
                                                                       value="{{$course->created_at}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Updated
                                                                    At</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Updated At" disabled
                                                                       name="updated_at"
                                                                       value="{{$course->updated_at}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="container">
                                                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                                                                <span class="navbar-brand">Teacher Information</span>
                                                            </nav>
                                                            <div class="form-group">
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Course
                                                                            Teacher</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select class="form-control" name="teacher_id">
                                                                            @foreach ($teachers as $teacher)
                                                                                @if($teacher->id==$course->teacher->id)
                                                                                    <option value="{{$teacher->id}}"
                                                                                            selected>
                                                                                        {{$teacher->getFullName()}}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{$teacher->id}}">
                                                                                        {{$teacher->getFullName()}}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Teacher
                                                                            ID</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="form-control" type="number"
                                                                               placeholder="Teacher ID" disabled
                                                                               value="{{$course->teacher->id}}">
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Teacher
                                                                            Email</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="form-control" type="email"
                                                                               placeholder="Teacher Name" disabled
                                                                               value="{{$course->teacher->email}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="container">
                                                            <nav class="navbar navbar-expand-lg navbar-dark"
                                                                 style="background: #309FDB">
                                                                <span class="navbar-brand">Category Information</span>
                                                            </nav>
                                                            <div class="form-group">
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Course
                                                                            Category</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select class="form-control" name="category_id">
                                                                            @foreach ($categories as $category)
                                                                                @if($category->id==$course->category->id)
                                                                                    <option value="{{$category->id}}"
                                                                                            selected>
                                                                                        {{$category->title}}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{$category->id}}">
                                                                                        {{$category->title}}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Category
                                                                            ID</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="form-control" type="number"
                                                                               placeholder="Category ID" disabled
                                                                               value="{{$course->category->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="container">
                                                            <nav class="navbar navbar-expand-lg navbar-dark">
                                                                <span class="navbar-brand">More Information</span>
                                                            </nav>
                                                            <div class="form-group">
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Schedule</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="form-control" type="text"
                                                                                  placeholder="Course Schedule"
                                                                                  name="schedule" rows="1">{{$course->schedule}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Requirements</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="form-control" type="text"
                                                                                  placeholder="Course Requirements"
                                                                                  name="requirements" rows="1">{{$course->requirements}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Syllabus</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="form-control" type="text"
                                                                                  placeholder="Course Syllabus"
                                                                                  name="syllabus" rows="1">{{$course->syllabus}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label mb-0 mt-2">Outline</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="form-control" type="text"
                                                                                  placeholder="Course Outline"
                                                                                  name="outline" rows="1">{{$course->outline}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a class="btn btn-danger" href="{{ URL('course') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab1">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Course Students Table</h3>
                                        <a class="btn btn-primary btn-sm" style="float: right;"
                                           data-target="#enrollStudentModal"
                                           data-toggle="modal" href="#"><i class="fas fa-folder"></i>
                                            Enroll Student</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="teachers_table" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 1%">#</th>
                                                    <th style="width: 15%">Student Name</th>
                                                    <th style="width: 5%">Image</th>
                                                    <th style="width: 20%">Email</th>
                                                    <th style="width: 5%">Gender</th>
                                                    <th style="width: 15%">Phone Number</th>
                                                    <th style="width: 5%">Courses</th>
                                                    <th style="width: 7%" class="text-center">Status</th>
                                                    <th style="width: 15%">Created At</th>
                                                    <th style="width: 8%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($course->students as $student)
                                                    <tr>
                                                        <td>{{$student->id}}</td>
                                                        <td>{{$student->getFullName()}}</td>
                                                        <td class="text-center">
                                                            <img src="{{$student->image_link}}" class="img-circle elevation-2"
                                                                 style="height: 40px" alt="User Image">
                                                        </td>
                                                        <td>{{$student->email}}</td>
                                                        <td>{{$student->getGender()}}</td>
                                                        <td>{{$student->phone_number}}</td>
                                                        <td class="text-center">{{$student->getCoursesCount()}}</td>
                                                        <td class="project-state text-center">
                                                            @if($student->status)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$student->created_at}}</td>
                                                        <td class="project-actions text-left">
                                                            <a class="btn btn-primary btn-sm" href="{{ URL('student/view/'.$student->id) }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                                <form style="display: inline-block;" method="POST"
                                                                      action="{{ URL('course/unenroll/'.$course->id) }}">
                                                                    <input type="hidden" name="_token"
                                                                           value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="student_id"
                                                                           value="{{ $student->id }}">
                                                                    <button class="btn btn-danger btn-sm"
                                                                            title="Unenroll" type="submit">
                                                                        <i class="fas fa-user-minus"></i>
                                                                    </button>
                                                                </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="enrollStudentModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enroll Student</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ URL('course/enroll/'.$course->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Course Title</label>
                            <input class="form-control" placeholder="Course Title" value="{{$course->title}}"
                                   type="text" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Select Student</label>
                            <select class="form-control" name="student_id">
                                @foreach ($students as $student)
                                    @if(!$course->isStudentEnrolled($student))
                                        <option value="{{$student->id}}">{{$student->getFullName()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
