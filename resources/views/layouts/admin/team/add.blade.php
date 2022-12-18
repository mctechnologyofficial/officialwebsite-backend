@extends('layouts.app')
@section('title', 'Add Team')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                {{--  --}}
                <div class="card-body">
                    <form autocomplete="off" method="POST" action="{{ route('admin.team.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="Team" class="form-label">Team Name</label>
                            <input type="text" name="name" class="form-control @erro" placeholder="Team 7">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
