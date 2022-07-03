<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Students') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('students') }}">Students</a></li>
        <li class="breadcrumb-item active">View Student</li>
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
                            <a class="nav-link active" data-toggle="tab" href="#tab0">Student Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab1">Courses</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab0">
                        <form method="post" action="{{ URL('student/update/'.$student->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="column p-2" style="width: 80%">
                                        <div class="row">
                                            <div class="col">
                                                <div class="container">
                                                    <nav class="navbar navbar-expand-lg navbar-dark"
                                                         style="background: #309FDB">
                                                        <span class="navbar-brand">Personal Information</span>
                                                    </nav>
                                                    <div class="form-group">
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">First Name</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="First Name"
                                                                       name="first_name"
                                                                       value="{{$student->first_name}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Last Name</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Last Name"
                                                                       name="last_name" value="{{$student->last_name}}">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Date Of
                                                                    Birth</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="date"
                                                                       placeholder="Date Of Birth"
                                                                       name="date_of_birth"
                                                                       value="{{$student->date_of_birth}}">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Gender</label>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-control" name="gender">
                                                                    @if ($student->gender)
                                                                        <option value="0" selected>Male</option>
                                                                        <option value="1">Female</option>
                                                                    @else
                                                                        <option value="0">Male</option>
                                                                        <option value="1" selected>Female</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="container">
                                                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                                                        <span class="navbar-brand">Contact information</span>
                                                    </nav>
                                                    <div class="form-group">
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Email
                                                                    Address</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="email"
                                                                       placeholder="Email Address"
                                                                       name="email"
                                                                       value="{{$student->email}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Phone Number</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="number"
                                                                       placeholder="Phone Number"
                                                                       name="phone_number"
                                                                       value="{{$student->phone_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Student
                                                                    Address</label>
                                                            </div>
                                                            <div class="col">
                                                            <textarea class="form-control" placeholder="Student Address"
                                                                      name="address"
                                                                      rows="3">{{$student->address}}</textarea>
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
                                                        <span class="navbar-brand">Account Information</span>
                                                    </nav>
                                                    <div class="form-group">
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Student uid</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Student uid" disabled
                                                                       name="id" value="{{$student->id}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Status</label>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-control" name="status">
                                                                    @if ($student->status)
                                                                        <option value="1" selected>Enabled</option>
                                                                        <option value="0">Disabled</option>
                                                                    @else
                                                                        <option value="1">Enabled</option>
                                                                        <option value="0" selected>Disabled</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-0 mt-2">
                                                                        Profile Photo
                                                                    </label>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="form-control" type="text"
                                                                           placeholder="Profile Photo"
                                                                           name="image_link"
                                                                           value="{{$student->image_link}}">
                                                                </div>
                                                            </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Created At</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Created At" disabled
                                                                       name="created_at"
                                                                       value="{{$student->created_at}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Updated At</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Updated At" disabled
                                                                       name="updated_at"
                                                                       value="{{$student->updated_at}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="container">
                                                    <nav class="navbar navbar-expand-lg navbar-dark">
                                                        <span class="navbar-brand">More Information</span>
                                                    </nav>
                                                    <div class="form-group">
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Courses
                                                                    Count</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="number"
                                                                       placeholder="Courses Count" disabled
                                                                       name="courses_count"
                                                                       value="{{$student->getCoursesCount()}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Linkedin</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Linkedin Profile"
                                                                       name="linkedin"
                                                                       value="{{$student->linkedin}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Github</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Github Profile"
                                                                       name="github"
                                                                       value="{{$student->github}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-0 mt-2">Stack
                                                                    Overflow</label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" type="text"
                                                                       placeholder="Stack Overflow Profile"
                                                                       name="stack_overflow"
                                                                       value="{{$student->stack_overflow}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column p-2" style="width: 20%">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <img alt="img" class="img-fluid" src="{{$student->image_link}}">
                                            </div>
                                            <div class="card-footer p-0">
                                                <div class="p-3 text-center">
                                                    <h5>Profile Photo</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a class="btn btn-danger" href="{{ URL('student') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab1">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header  border-0">
                                        <h4 class="card-title">Student Courses</h4>
                                    </div>
                                    <div class="card-body">
                                        <table id="courses_table" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 1%">#</th>
                                                <th style="width: 15%">Course Title</th>
                                                <th style="width: 5%">Image</th>
                                                <th style="width: 10%">Teacher Name</th>
                                                <th style="width: 8%">Category</th>
                                                <th style="width: 5%">Credits</th>
                                                <th style="width: 5%">Price</th>
                                                <th style="width: 5%">Students</th>
                                                <th style="width: 15%">Created At</th>
                                                <th style="width: 15%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($student->courses as $course)
                                                <tr>
                                                    <td>{{$course->id}}</td>
                                                    <td>{{$course->title}}</td>
                                                    <td class="text-center">
                                                        <img src="{{ asset('img/user.png') }}"
                                                             class="img-circle elevation-2"
                                                             style="height: 40px" alt="Course Image">
                                                    </td>
                                                    <td>{{$course->teacher->getFullName()}}</td>
                                                    <td>{{$course->category->title}}</td>
                                                    <td>{{$course->num_of_hours}}</td>
                                                    <td>{{$course->price}}</td>
                                                    <td>{{$course->getStudentsCount()}}</td>
                                                    <td>{{$course->created_at}}</td>
                                                    <td class="project-actions text-left">
                                                        <a class="btn btn-primary btn-sm"
                                                           href="{{ URL('course/view/'.$course->id) }}">
                                                            <i class="fas fa-folder"></i> View
                                                        </a>
                                                        <form style="display: inline-block;" method="POST"
                                                              action="{{ URL('course/delete/'.$course->id) }}">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">
                                                            <button class="btn btn-danger btn-sm" type="submit">
                                                                <i class="fas fa-trash"></i> Delete
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
    </section>
</x-app-layout>
