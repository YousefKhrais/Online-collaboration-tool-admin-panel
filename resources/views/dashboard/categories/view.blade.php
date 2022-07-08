<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Categories') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories') }}">Categories</a></li>
        <li class="breadcrumb-item active">View Category</li>
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
                            <a class="nav-link active" data-toggle="tab" href="#tab0">Category Details</a>
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
                        <form method="post" action="{{ URL('category/update/'.$category->id) }}">
                            @csrf
                            <div class="card-body w-100">
                                <div class="col w-100">
                                    <nav class="navbar navbar-expand-lg navbar-dark"
                                         style="background: #309FDB">
                                        <span class="navbar-brand">General Information</span>
                                    </nav>
                                    <div class="form-group">
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">Category uid</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="number"
                                                       placeholder="Category uid" disabled
                                                       value="{{$category->id}}">
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
                                                       value="{{$category->title}}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">Category
                                                    Image</label>
                                            </div>
                                            <div class="col">
                                                <div class="input-group file-browser">
                                                    <input
                                                        class="form-control border-right-0 browse-file"
                                                        placeholder="{{$category->image_link}}" readonly
                                                        name="image_link"
                                                        value="{{$category->image_link}}"
                                                        type="text">
                                                    <label class="input-group-append mb-0">
                                                                    <span class="btn ripple btn-primary">Browse
                                                                        <input style="display: none;" type="file">
                                                                    </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">Category
                                                    Description</label>
                                            </div>
                                            <div class="col">
                                                            <textarea class="form-control"
                                                                      placeholder="Category Description"
                                                                      name="description"
                                                                      rows="5">{{$category->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">Courses
                                                    Count</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="number"
                                                       placeholder="Courses Count" disabled
                                                       value="{{$category->getCoursesCount()}}">
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
                                                       value="{{$category->created_at}}">
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
                                                       value="{{$category->updated_at}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a class="btn btn-danger" href="{{ URL('category') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab1">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-lg-12">
                                <div class="card">
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
                                            @foreach ($category->courses as $course)
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
