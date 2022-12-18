@extends('layouts.app')
@section('title', 'Member')

@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="card-header mb-3 text-right pr-0">
                    <a href="{{ route('admin.member.create') }}" class="btn btn-outline-success mb-2">+ Add New Member</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-5p">#</th>
                                <th class="wd-20p">Name</th>
                                <th class="wd-20p">Email</th>
                                <th class="wd-20p">Position</th>
                                <th class="wd-20p">Team</th>
                                <th class="wd-20p">Image</th>
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
                                    <td>
                                        <a href="" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                        <form action="" method="post">
                                            @csrf
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
