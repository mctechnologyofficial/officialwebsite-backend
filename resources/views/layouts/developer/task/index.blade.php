@extends('layouts.app')
@section('title', 'Tasks')

@section('content')
    <div class="sortable">
        <div class="row row-sm">
            <div class="col-lg-4 col-sm-12 screencontainer" id="0">
                <div class="card custom-card card-draggable bg-danger-light tx-white">
                    <div class="card-body">
                        <p class="mg-b-0">Not yet in progress</p>
                    </div>
                </div>
                @foreach ($notyet as $data)
                    <div class="card custom-card task-item card-draggable @if($data->priority == 0) bg-success @elseif($data->priority == 1) bg-warning @else bg-danger @endif text-white" id="{{ $data->id }}">
                        {{-- <input type="hidden" value="{{ $data->id }}" id="noprogressid"> --}}
                        <div class="card-body" id="{{ $data->id }}">
                            <p class="mg-b-0">
                                {{ $data->task }}
                            </p>
                        </div>
                        <div class="card-footer @if($data->priority == 0) bg-success @elseif($data->priority == 1) bg-warning @else bg-danger @endif text-white">
                            {{ Carbon\Carbon::parse($data->created_at)->format(' j F Y h:i A') }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4 col-sm-12 screencontainer" id="1">
                <div class="card custom-card card-draggable bg-warning-light tx-white">
                    <div class="card-body">
                        <p class="mg-b-0">In progress</p>
                    </div>
                </div>
                @foreach ($progress as $data)
                    <div class="card custom-card task-item card-draggable @if($data->priority == 0) bg-success @elseif($data->priority == 1) bg-warning @else bg-danger @endif text-white" id="{{ $data->id }}">
                        {{-- <input type="hidden" value="{{ $data->id }}" id="inprogressid"> --}}
                        <div class="card-body" id="{{ $data->id }}">
                            <p class="mg-b-0">
                                {{ $data->task }}
                            </p>
                        </div>
                        <div class="card-footer @if($data->priority == 0) bg-success @elseif($data->priority == 1) bg-warning @else bg-danger @endif text-white">
                            {{ Carbon\Carbon::parse($data->created_at)->format(' j F Y h:i A') }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4 col-sm-12 screencontainer" id="2">
                <div class="card custom-card card-draggable bg-success-light tx-white">
                    <div class="card-body">
                        <p class="mg-b-0">Completed</p>
                    </div>
                </div>
                @foreach ($complete as $data)
                    <div class="card custom-card task-item card-draggable @if($data->priority == 0) bg-success @elseif($data->priority == 1) bg-warning @else bg-danger @endif text-white" id="{{ $data->id }}">
                        {{-- <input type="hidden" value="{{ $data->id }}" id="completedid"> --}}
                        <div class="card-body" id="{{ $data->id }}">
                            <p class="mg-b-0">
                                {{ $data->task }}
                            </p>
                        </div>
                        <div class="card-footer @if($data->priority == 0) bg-success @elseif($data->priority == 1) bg-warning @else bg-danger @endif text-white">
                            {{ Carbon\Carbon::parse($data->created_at)->format(' j F Y h:i A') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('js')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            var taskid;

            function triggerTaskNotification() {
                $.ajax({
                    type: 'GET',
                    url: "/task/gettask",
                    data: {
                        _token: CSRF_TOKEN,
                    },
                    success: (response) => {
                        getTask(response);
                    }
                });
            }

            function getTask(response) {
                //
            }

            $('.task-item').mousedown(function(){
                taskid = (this.id);
            });

            $('.screencontainer').droppable({
                drop: function(event, ui){
                    var id = $(event.target).attr('id');

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('it.task.update') }}",
                        data: {
                            taskid: taskid,
                            status: id,
                        },
                        success: (response) => {
                            alert('oke');
                        }
                    });
                }
            });
        });
    </script>
@endsection
