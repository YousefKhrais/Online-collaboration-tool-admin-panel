<x-app-layout>
    <x-slot name="header">
        <h5 class="m-0">{{ __('Dashboard') }}</h5>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$teachers_count}}</h3>
                            <p>Teachers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('teachers') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$students_count}}</h3>
                            <p>Students</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('students') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg col-6">
                    <div class="small-box bg-gradient-orange">
                        <div class="inner" style="color: white">
                            <h3>{{$courses_count}}</h3>
                            <p>Courses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('courses') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$categories_count}}</h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('categories') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg col-6">
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3>{{$requests_count}}</h3>
                            <p>Courses Requests</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('requests') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
