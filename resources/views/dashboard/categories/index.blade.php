<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Categories') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Categories</li>
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
                    <h3 class="card-title">Categories Table</h3>
                    <a class="btn btn-primary btn-sm" style="float: right;" data-target="#addCategoryModal"
                       data-toggle="modal" href="#"><i class="fas fa-folder"></i> Add Category</a>
                </div>
                <div class="card-body">
                    <table id="categories_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 20%">Category Title</th>
                            <th style="width: 5%">Courses</th>
                            <th style="width: 50%">Description</th>
                            <th style="width: 15%">Created At</th>
                            <th style="width: 9%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->title}}</td>
                                <td>{{$category->getCoursesCount()}}</td>
                                <td>{{$category->description}}</td>
                                <td>{{$category->created_at}}</td>
                                <td class="project-actions text-left">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ URL('category/view/'.$category->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form style="display: inline-block;" method="POST"
                                          action="{{ URL('category/delete/'.$category->id) }}">
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

    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Category Title</label>
                            <input class="form-control" placeholder="Enter Category Title" type="text"
                                   name="title">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description"
                                      placeholder="Category Description"
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
