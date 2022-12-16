@extends('layouts.app')
@section('title', 'Member')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive text-nowrap m-4">
                    <table class="table table-hover table-bordered" id="mytable">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-white">#</th>
                                <th class="text-white" data-priority='1'>Name</th>
                                <th class="text-white">Email</th>
                                <th class="text-white">Position</th>
                                <th class="text-white">Team Name</th>
                                <th class="text-white">Image</th>
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($member as $key => $data)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->roles->first()->name }}</td>
                                    <td>{{ $data->teamname }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset($data->image) }}" alt="image" class="img-thumbnail w-75">
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="bx bx-trash me-1"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
