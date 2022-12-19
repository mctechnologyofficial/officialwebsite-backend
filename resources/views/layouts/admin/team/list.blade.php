@extends('layouts.app')
@section('title', 'team')

@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card overflow-hidden">
            {{--  --}}
            <div class="card-body">
                <div class="card-header mb-3 text-right pr-0">
                    <a href="{{ route('admin.team.create') }}" class="btn btn-outline-success mb-3">+ Add New Team</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-20p">Name</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $d->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.team.edit', $d->id) }}" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                        <form action="{{ route('destroy', $d->id) }}"onsubmit="return confirm('are you sure for delete this?')"  method="POST">
                                            @csrf
                                            @method('DELETE')
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
