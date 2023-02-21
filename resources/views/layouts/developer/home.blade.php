@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <!--Row-->
    <div class="row row-sm">
        <!-- Col -->
        <div class="col-sm-12 col-lg-12 col-xl-8">
            <!--Row-->
            <div class="row row-sm  mt-lg-4">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="card bg-primary custom-card card-box">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="offset-lg-4 offset-sm-6 col-lg-8 col-sm-6 col-12">
                                    <h4 class="d-flex  mb-3">
                                        <span class="font-weight-bold text-white ">Welcome {{ Auth::user()->name }}</span>
                                    </h4>
                                    @if($percentage == 0)
                                    <p class="tx-white-7 mb-1">You have {{ $totalproject }} projects to finish. Accept your tasks now!</p>
                                    @elseif ($percentage == 100)
                                        <p class="tx-white-7 mb-1">You had completed <b class="text-warning">{{ $percentage }}%</b> from your tasks. Congratulations!</p>
                                    @else
                                        <p class="tx-white-7 mb-1">You have {{ $totalproject }} projects to finish, you had completed <b class="text-warning">{{ $percentage }}%</b> from your tasks. Keep going to your tasks!</p>
                                    @endif
                                </div>
                                <img src="{{ asset('assets/img/pngs/work3.png') }}" alt="user-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row -->

            <!--Row-->
            <div class="row row-sm">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-item">
                                <div class="card-item-icon card-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24"
                                        viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3" />
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z" />
                                    </svg>
                                </div>
                                <div class="card-item-title mb-2">
                                    <label class="main-content-label tx-13 font-weight-bold mb-1">Total Teams</label>
                                    <span class="d-block tx-12 mb-0 text-muted">Team member of {{ $team->name }}</span>
                                </div>
                                <div class="card-item-body">
                                    <div class="card-item-stat">
                                        <h4 class="font-weight-bold">{{ $totalteam }}</h4>
                                        {{-- <small><b class="text-success">5%</b> Increased</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-item">
                                <div class="card-item-icon card-icon">
                                    <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                                        <g>
                                            <rect height="14" opacity=".3" width="14" x="5" y="5" />
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <g>
                                                    <path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z" />
                                                    <rect height="5" width="2" x="7" y="12" />
                                                    <rect height="10" width="2" x="15" y="7" />
                                                    <rect height="3" width="2" x="11" y="14" />
                                                    <rect height="2" width="2" x="11" y="10" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="card-item-title mb-2">
                                    <label class="main-content-label tx-13 font-weight-bold mb-1">Total Projects</label>
                                    <span class="d-block tx-12 mb-0 text-muted">Total projects to be handled</span>
                                </div>
                                <div class="card-item-body">
                                    <div class="card-item-stat">
                                        <h4 class="font-weight-bold">{{ $totalproject }}</h4>
                                        {{-- <small><b class="text-success">5%</b> Increased</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End row-->

            <!--row-->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            <div class="card-header pt-0 pl-0 pr-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">Tasks</label> <span class="d-block tx-12 mb-2 text-muted">A task is accomplished by a set deadline, and must contribute toward work-related objectives.</span>
                                </div>
                            </div>
                            <div class="table-responsive tasks">
                                <table
                                    class="table card-table table-vcenter text-nowrap mb-0 border-top-0 border">
                                    <thead>
                                        <tr>
                                            <th class="wd-lg-10p">Task</th>
                                            <th class="wd-lg-20p">Team</th>
                                            <th class="wd-lg-20p text-center">Project</th>
                                            <th class="wd-lg-20p">Prority</th>
                                            <th class="wd-lg-20p">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task as $data)
                                            <tr>
                                                <td class="font-weight-semibold d-flex">
                                                    <label class="ckbox my-auto mr-4 mt-1">
                                                        <input @if($data->status == 2) checked @endif type="checkbox" onclick="return false;" />
                                                        <span></span>
                                                    </label>
                                                    <span class="mt-1">{{ $data->task }}</span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="demo-avatar-group my-auto float-right">
                                                        @foreach ($membertask as $member)
                                                        <div class="main-img-user avatar-sm">
                                                            <img alt="avatar" class="rounded-circle" src="{{ asset($member->image != null ? $member->image : 'assets/img/users/1.jpg') }}">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $data->name }}<i class=""></i></td>
                                                @if ($data->priority == 2)
                                                    <td class="text-danger">High</td>
                                                @elseif ($data->priority == 1)
                                                    <td class="text-warning">Normal</td>
                                                @else
                                                    <td class="text-success">Low</td>
                                                @endif
                                                <td>
                                                    @if ($data->status == 0)
                                                        <span class="badge badge-pill badge-danger-light">Not yet in progress</span>
                                                    @elseif ($data->status == 1)
                                                        <span class="badge badge-pill badge-warning-light">In progress</span>
                                                    @else
                                                        <span class="badge badge-pill badge-success-light">Completed</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- col end -->
            </div>
            <!-- Row end -->

        </div>
        <!-- col end -->
        <!-- col -->
        <div class="col-sm-12 col-lg-12 col-xl-4 mt-xl-4">
            {{-- <div class="card custom-card">
                <div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
                    <div>
                        <label class="main-content-label mb-2 pt-2">On going projects</label>
                        <span class="d-block tx-12 mb-2 text-muted">Projects where development work is on completion</span>
                    </div>
                </div>
                <div class="card-body pt-2 mt-0">
                    @foreach ($project as $value)
                        <div class="list-card">
                            <div class="d-flex">
                                <div class="demo-avatar-group my-auto float-right">
                                    @foreach ($membertask as $member)
                                        <div class="main-img-user avatar-xs">
                                            <img alt="avatar" class="rounded-circle" src="{{ asset($member->image != null ? $member->image : 'assets/img/users/1.jpg') }}">
                                        </div>
                                    @endforeach
                                    <div class="ml-2">{{ $value->name }}</div>
                                </div>
                            </div>
                            <div class="card-item mt-4">
                                <div class="card-item-icon bg-transparent card-icon">
                                </div>
                                <div class="card-item-body">
                                    <div class="card-item-stat">
                                        <small class="tx-10 text-primary font-weight-semibold">{{ Carbon\Carbon::parse($value->created_at)->format('j F Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
            <div class="card custom-card">
                @foreach ($project as $record)
                    <div class="card-body">
                        <div class="d-flex">
                            <label class="main-content-label my-auto">{{ $record->name }}</label>
                            <div class="ml-auto  d-flex">
                                <div class="mr-3 d-flex text-muted tx-13">Running</div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div>
                                <span class="tx-15 text-muted">Task completed : {{ $finishtask }} / {{ $totaltask }}</span>
                            </div>
                            <div class="container mt-2 mb-2">
                                <canvas id="bar-chart" class="ht-180"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mt-4">
                                    <div class="d-flex mb-2">
                                        <h5 class="tx-15 my-auto text-muted font-weight-normal">Client : </h5>
                                        <h5 class="tx-15 my-auto ml-3">{{ $record->company }}</h5>
                                    </div>
                                    <div class="d-flex mb-0">
                                        <h5 class="tx-13 my-auto text-muted font-weight-normal">Deadline : </h5>
                                        <h5 class="tx-13 my-auto text-muted ml-2">{{ Carbon\Carbon::parse($record->deadline)->format('j F Y') }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-auto">
                                <div class="mt-3">
                                    <div class="">
                                        <img alt="" class="ht-50" src="{{ asset($record->image != null ? $record->image : 'assets/img/media/project-logo.png') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- col end -->
    </div>
    <!-- Row end -->
@endsection

@section('js')
<!-- Circle Progress js-->
<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/js/chart-circle.js') }}"></script>

<!-- Internal Morris js -->
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris.js/morris.min.js') }}"></script>

<!-- Chart.Bundle js-->
<script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<!-- Peity js-->
<script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>

<!-- Flot Chart js-->
<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>

<!-- Dashboard js-->
<script src="{{ asset('assets/js/index.js') }}"></script>
@endsection
