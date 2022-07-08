<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Requests') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Requests</li>
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
                            <a class="nav-link active" data-toggle="tab" href="#tab0">Open Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab1">Closed Requests</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="courses_table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 1%">#ID</th>
                                            <th style="width: 15%">Teacher Name</th>
                                            <th style="width: 25%">Title</th>
                                            <th style="width: 5%">Status</th>
                                            <th style="width: 20%">Admin Note</th>
                                            <th style="width: 15%">Created At</th>
                                            <th style="width: 15%">Updated At</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($requests as $request)
                                            @if($request->status ==0)
                                                <tr>
                                                    <td>{{$request->id}}</td>
                                                    <td>{{$request->teacher->getFullName()}}</td>
                                                    <td>{{$request->title}}</td>
                                                    <td class="project-state text-center">
                                                        @if($request->status ==0)
                                                            <span class="badge badge-primary">Open</span>
                                                        @elseif($request->status==1)
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @elseif($request->status==2)
                                                            <span class="badge badge-success">Accepted</span>
                                                        @else
                                                            <span class="badge badge-warning">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$request->admin_note}}</td>
                                                    <td>{{$request->created_at}}</td>
                                                    <td>{{$request->updated_at}}</td>
                                                    <td class="project-actions text-center">
                                                        <a class="btn btn-primary btn-sm" title="View"
                                                           href="{{ URL('request/view/'.$request->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="courses_table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 1%">#ID</th>
                                            <th style="width: 15%">Teacher Name</th>
                                            <th style="width: 25%">Title</th>
                                            <th style="width: 5%">Status</th>
                                            <th style="width: 20%">Admin Note</th>
                                            <th style="width: 15%">Created At</th>
                                            <th style="width: 15%">Updated At</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($requests as $request)
                                            @if($request->status !=0)
                                                <tr>
                                                    <td>{{$request->id}}</td>
                                                    <td>{{$request->teacher->getFullName()}}</td>
                                                    <td>{{$request->title}}</td>
                                                    <td class="project-state text-center">
                                                        @if($request->status ==0)
                                                            <span class="badge badge-primary">Open</span>
                                                        @elseif($request->status==1)
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @elseif($request->status==2)
                                                            <span class="badge badge-success">Accepted</span>
                                                        @else
                                                            <span class="badge badge-warning">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$request->admin_note}}</td>
                                                    <td>{{$request->created_at}}</td>
                                                    <td>{{$request->updated_at}}</td>
                                                    <td class="project-actions text-center">
                                                        <a class="btn btn-primary btn-sm" title="View"
                                                           href="{{ URL('request/view/'.$request->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
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
    </section>
</x-app-layout>
