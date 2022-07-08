<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Requests') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('requests') }}">Requests</a></li>
        <li class="breadcrumb-item active">View Request</li>
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
            <div class="card-header p-2">Request Details</div>
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
                                                <label class="form-label mb-0 mt-2">Course Title</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="text"
                                                       placeholder="Course Title"
                                                       name="title" readonly
                                                       value="{{$request->title}}">
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
                                                       name="credit" readonly
                                                       value="{{$request->num_of_hours}}">
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
                                                       name="price" readonly
                                                       value="{{$request->price}}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">Course Image</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="text"
                                                       placeholder="Course Image"
                                                       name="image_link" readonly
                                                       value="{{$request->image_link}}">
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
                                                                      name="description" readonly
                                                                      rows="3">{{$request->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">Created
                                                    At</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="text"
                                                       placeholder="Created At" readonly
                                                       name="created_at"
                                                       value="{{$request->created_at}}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <label class="form-label mb-0 mt-2">Updated
                                                    At</label>
                                            </div>
                                            <div class="col">
                                                <input class="form-control" type="text"
                                                       placeholder="Updated At" readonly
                                                       name="updated_at"
                                                       value="{{$request->updated_at}}">
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
                                                        <label class="form-label mb-0 mt-2">Teacher
                                                            ID</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-control" type="number"
                                                               placeholder="Teacher ID" readonly
                                                               value="{{$request->teacher->id}}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">Teacher
                                                            Email</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-control" type="email"
                                                               placeholder="Teacher Name" readonly
                                                               value="{{$request->teacher->email}}">
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
                                                        <label class="form-label mb-0 mt-2">Category
                                                            ID</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-control" type="number"
                                                               placeholder="Category ID" readonly
                                                               value="{{$request->category->id}}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">Category
                                                            Title</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-control" type="text"
                                                               placeholder="Category ID" readonly
                                                               value="{{$request->category->title}}">
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
                                                        <label class="form-label mb-0 mt-2">Request Status</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-control" type="text"
                                                               placeholder="Request Status" readonly
                                                               value="{{$request->getStatus()}}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label mb-0 mt-2">Admin Note</label>
                                                    </div>
                                                    <div class="col">
                                                        <textarea class="form-control" rows="3"
                                                                  readonly>{{$request->admin_note}}</textarea>
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
                @if($request->status==0)
                    <a class="btn btn-success" data-toggle="modal" data-target="#acceptRequestModal">Accept</a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#rejectRequestModal">Reject</a>
                @endif
                <a class="btn btn-dark" href="{{ URL('request') }}">Cancel</a>
            </div>
        </div>
    </section>

    <div class="modal fade" id="acceptRequestModal" tabindex="-1" role="dialog" aria-labelledby="acceptRequestModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Accept Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL('request/accept/'.$request->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="admin_note" class="col-form-label">Admin Note: (Optional)</label>
                            <textarea class="form-control" id="admin_note" name="admin_note" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="rejectRequestModal" tabindex="-1" role="dialog" aria-labelledby="rejectRequestModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reject Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ URL('request/reject/'.$request->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="admin_note" class="col-form-label">Admin Note: (Optional)</label>
                            <textarea class="form-control" id="admin_note" name="admin_note" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
