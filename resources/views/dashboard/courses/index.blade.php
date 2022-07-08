<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Courses') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Courses</li>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Courses Table</h3>
                    <a class="btn btn-primary btn-sm" style="float: right;" data-target="#addCourseModal"
                       data-toggle="modal" href="#"><i class="fas fa-folder"></i> Add Course</a>
                </div>
                <div class="card-body">
                    <table id="courses_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 18%">Course Title</th>
                            <th style="width: 3%">Image</th>
                            <th style="width: 13%">Teacher Name</th>
                            <th style="width: 13%">Category</th>
                            <th style="width: 8%">Credits</th>
                            <th style="width: 5%">Price</th>
                            <th style="width: 5%">Students</th>
                            <th style="width: 13%">Created At</th>
                            <th style="width: 8%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{$course->id}}</td>
                                <td>{{$course->title}}</td>
                                <td class="text-center">
                                    <img src="{{$course->image_link}}" class="img-circle elevation-2"
                                         style="height: 40px" alt="Course Image">
                                </td>
                                <td>{{$course->teacher->getFullName()}}</td>
                                <td>{{$course->category->title}}</td>
                                <td>{{$course->num_of_hours}} Hours</td>
                                <td>{{$course->price}}$</td>
                                <td>{{$course->getStudentsCount()}}</td>
                                <td>{{$course->created_at}}</td>
                                <td class="project-actions text-left">
                                    <a class="btn btn-primary btn-sm" href="{{ URL('course/view/'.$course->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form style="display: inline-block;" method="POST"
                                          action="{{ URL('course/delete/'.$course->id) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fas fa-trash"></i>
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

    <div class="modal fade" id="addCourseModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('course.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Course Title</label>
                            <input class="form-control" placeholder="Enter Course Title" type="text"
                                   name="title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Number Of Hours (Course Credit)</label>
                            <input class="form-control" placeholder="Enter Course Credit" type="number"
                                   name="credit">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Course Price</label>
                            <input class="form-control" placeholder="Enter Course Price" type="number"
                                   name="price">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Teacher</label>
                            <select class="form-control" name="teacher_id">
                                <option value="0" selected>Select Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->getFullName()}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select class="form-control" name="category_id">
                                <option value="0" selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description"
                                      placeholder="Course Description"
                                      rows="5"></textarea>
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
