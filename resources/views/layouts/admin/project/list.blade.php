@extends('layouts.app')
@section('title', 'Project')

@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card overflow-hidden mb-3">
            @if ($message = Session::get('success'))
                <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
                        onClick: function(){} // Callback after click
                    }).showToast();
                </script>
            @endif
            <div class="card-body">
                <div class="card-header mb-3 text-right pr-0">
                    <a href="{{ route('admin.project.create') }}" class="btn btn-outline-success mb-3">+ Add New Project</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-5p">#</th>
                                <th class="wd-20p">Project Name</th>
                                <th class="wd-20p">Handle By</th>
                                <th class="wd-20p">Github Repository URL</th>
                                <th class="wd-20p">Image</th>
                                <th class="wd-20p">Status</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->teamname }}</td>
                                    <td>{{ $data->github_repository }}</td>
                                    <td align="center">
                                        <img src="{{ asset($data->image != null ? $data->image : 'assets/img/media/1.jpg') }}" alt="userimg" class="img-thumbnail w-100" />
                                    </td>
                                    <td align="center">
                                        @if ($data->status == 0)
                                            <span class="badge badge-warning">Waiting to be accepted</span>
                                        @elseif ($data->status == 1)
                                            <span class="badge badge-success">Accepted</span>
                                        @else
                                            <span class="badge badge-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.project.edit', $data->id) }}" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                        <form action="{{ route('admin.project.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
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
@endsection
