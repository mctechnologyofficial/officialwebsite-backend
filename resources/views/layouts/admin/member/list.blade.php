@extends('layouts.app')
@section('title', 'Member')

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
                    <a href="{{ route('admin.member.create') }}" class="btn btn-outline-success mb-3">+ Add New Member</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="example1">
                        <thead style="background-color: #0273ed;">
                            <tr>
                                <th class="wd-5p">#</th>
                                <th class="wd-20p">Name</th>
                                <th class="wd-20p">Email</th>
                                <th class="wd-20p">Position</th>
                                <th class="wd-20p">Team</th>
                                <th class="wd-20p">Image</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($member as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ ucwords($data->roles->first()->name) }}</td>
                                    <td>{{ $data->teamname }}</td>
                                    <td align="center">
                                        <img src="{{ asset($data->image) }}" alt="userimg" class="img-thumbnail w-100" />
                                    </td>
                                    <td align="center">
                                        @if(Cache::has('user-is-online-' . $data->id))
                                            <span class="badge badge-success">Online</span>
                                        @else
                                            <span class="badge badge-danger">Offline</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.member.edit', $data->id) }}" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                        <form action="{{ route('admin.member.destroy', $data->id) }}" method="post">
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
