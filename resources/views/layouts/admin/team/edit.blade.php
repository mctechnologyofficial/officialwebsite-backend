@extends('layouts.app')
@section('title', 'Edit Team')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form autocomplete="off" method="POST" action="{{ route('admin.team.update', $attrs->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="Team" class="form-label">Team Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Team 7" value="{{ $attrs->name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
