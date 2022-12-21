@extends('layouts.app')
@section('title', 'Manage Project')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden mb-3">
                <div class="card-header">
                    <div>
                        <label class="main-content-label mb-2">Create Tasks</label>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('leader.project.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Project Name</label>
                            <input type="hidden" name="project_id" id="projectid" value="{{ $project->id }}" />
                            <input type="text" class="form-control @error('project_id') is-invalid @enderror" id="exampleInputPassword1" value="{{ $project->name }}" readonly />
                            @error('project_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Member</label>
                            <select name="member_id" class="form-control @error('member_id') is-invalid @enderror">
                                <option value="" selected disabled>Choose member</option>
                                @foreach ($member as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }} ({{ ucwords($data->roles->first()->name) }})</option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Task</label>
                            <textarea class="form-control" cols="30" rows="10" name="task" class="@error('task') is-invalid @enderror"></textarea>
                            @error('task')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden mb-3">
                <div class="card-header">
                    <div>
                        <label class="main-content-label mb-2">Member Tasks</label>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <link rel="stylesheet" type="text/css"
                            href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
                        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

                        <script>
                            Toastify({
                                avatar: "{{ asset('assets/img/brand/logo-mc.png') }}",
                                text: {!! json_encode($message) !!},
                                duration: 5000,
                                destination: "https://github.com/apvarun/toastify-js",
                                newWindow: true,
                                close: true,
                                gravity: "bottom", // `top` or `bottom`
                                position: "right", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "#49b462",
                                    color: '#fff',
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();
                        </script>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-5p">#</th>
                                    <th class="wd-20p">Member</th>
                                    <th class="wd-20p">Position</th>
                                    <th class="wd-20p">Team</th>
                                    <th class="wd-20p">Task</th>
                                    <th class="wd-20p">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todolist as $key => $data)
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ ucwords($data->roles->first()->name) }}</td>
                                    <td>{{ $data->teamname }}</td>
                                    <td>{{ $data->task }}</td>
                                    <td align="center">
                                        @if ($data->status == 0)
                                            <span class="badge badge-danger">Not yet in progress</span>
                                        @elseif ($data->status == 1)
                                            <span cla `ss="badge badge-warning">In progress</span>
                                        @else
                                            <span class="badge badge-success">Completed</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
