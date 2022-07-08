<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Teachers') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Teachers</li>
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
                    <h3 class="card-title">Teachers Table</h3>
                    <a class="btn btn-primary btn-sm" style="float: right;" data-target="#addTeacherModal"
                       data-toggle="modal" href="#"><i class="fas fa-folder"></i> Add Teacher</a>
                </div>
                <div class="card-body">
                    <table id="teachers_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 15%">Teacher Name</th>
                            <th style="width: 5%">Image</th>
                            <th style="width: 25%">Email</th>
                            <th style="width: 5%">Gender</th>
                            <th style="width: 15%">Phone Number</th>
                            <th style="width: 5%">Courses</th>
                            <th style="width: 15%">Created At</th>
                            <th style="width: 5%" class="text-center">Status</th>
                            <th style="width: 9%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{$teacher->id}}</td>
                                <td>{{$teacher->getFullName()}}</td>
                                <td class="text-center">
                                    <img src="{{$teacher->image_link}}" class="img-circle elevation-2"
                                         style="height: 40px" alt="User Image">
                                </td>
                                <td>{{$teacher->email}}</td>
                                <td>{{$teacher->getGender()}}</td>
                                <td>{{$teacher->phone_number}}</td>
                                <td class="text-center">{{$teacher->getCoursesCount()}}</td>
                                <td>{{$teacher->created_at}}</td>
                                <td class="project-state text-center">
                                    @if($teacher->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="project-actions text-left">
                                    <a class="btn btn-primary btn-sm" href="{{ URL('teacher/view/'.$teacher->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form style="display: inline-block;" method="POST"
                                          action="{{ URL('teacher/delete/'.$teacher->id) }}">
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

    <div class="modal fade" id="addTeacherModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Teacher</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('teacher.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">First Name</label>
                                    <input class="form-control" placeholder="Enter First Name" type="text"
                                           name="first_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input class="form-control" placeholder="Enter Last Name" type="text"
                                           name="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input class="form-control" placeholder="Enter Date of Birth" type="date"
                                           name="date_of_birth">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input class="form-control" placeholder="Enter Phone Number" type="number"
                                           name="phone_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input class="form-control" placeholder="Enter Email Address" type="email"
                                           name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" placeholder="Enter Password" type="password"
                                           name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="0" selected>Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Full Address</label>
                            <textarea class="form-control" name="address"
                                      placeholder="Academic Full Address"
                                      rows="3"></textarea>
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
